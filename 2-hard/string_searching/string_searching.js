/*
* Challenge description:
* https://www.codeeval.com/open_challenges/28
*/

var fs = require('fs');

fs.readFileSync(process.argv[2]).toString().split("\n").forEach(function (line) {
	if (line == "") {
		return;
	}

	line = line.split(",");
	console.log(matchSubstring(line[0], line[1].trim()));
});

function Matcher(substr) {
	this.initSubstr = substr;
	this.substr = substr;
	this.mode = "init";
	this.char = "";

	this.nextChar = function () {
		if (this.substr === '') {
			this.mode = "finished";
			this.char = '';
			return {mode: this.mode, char: this.char};
		}

		if (this.substr[0] === "*") {
			var nextChar = "";
			for (var i = 1; i < this.substr.length; i++) {
				nextChar = this.substr[i];
				if (nextChar !== "*") {
					break;
				}
			}
			this.substr = this.substr.slice(1);
			this.mode = "any";
			this.char = nextChar;
			return {mode: this.mode, char: this.char}
		}

		if (this.substr[0] === "\\") {
			if (this.substr[1] === "*" ) {
				this.substr = this.substr.slice(2);
				this.mode = "exact";
				this.char = "*";
				return {mode: this.mode, char: this.char}
			} else {
				this.mode = "exact";
				this.char = this.substr[1];
				this.substr = this.substr.slice(2);
				
				return {mode: this.mode, char: this.char}
			}
		}

		this.mode = "exact";
		this.char = this.substr[0];
		this.substr = this.substr.slice(1);
		return {mode: this.mode, char: this.char}
	}

	this.reset = function () {
		this.substr = this.initSubstr;
		this.nextChar();
	}

	this.lastChar = function () {
		return (this.substr === '');
	} 
}



function matchSubstring(str, substr) {
	var matcher = new Matcher(substr);
	var startIndex = 0;
	var matched = "";
	while(true) {
		matcher.nextChar();
		if (matcher.mode == "finished") {
			return true;
		}
		
		for(i = startIndex; i < str.length; i++) {
			if (matcher.mode === "exact") {
				if (matcher.char === str[i]) {
					matched += str[i];
					startIndex = i + 1;
					break;
				} else {
					matcher.reset();
					matched = "";
				}
			}

			if (matcher.mode === "any") {
				if(matcher.char !== str[i]) {
					matched += str[i];
					startIndex = i + 1;
				} else {
					break;	
				} 
				
			}


			if (i >= str.length - 1 && matcher.mode !== "any")
			{
				return false;
			}
			
		}

		if (startIndex >= str.length && !matcher.lastChar()) {
			return false;
		}
	}
}