/*
* Challenge description:
* https://www.codeeval.com/open_challenges/102
*/

var fs = require('fs');

fs.readFileSync(process.argv[2]).toString().split("\n").forEach(function (line) {
	if (line == "") {
		return;
	}
	var regExp = /\"id\"\: (\d+), \"label\"/g;
	var matchArray;
	var sum = 0;
	while ((matchArray = regExp.exec(line)) !== null) {
		sum += parseInt(matchArray[1]);
	}

	console.log(sum);
});