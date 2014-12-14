/*
* Challenge description:
* https://www.codeeval.com/open_challenges/40
*/

var fs  = require("fs");
fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line !== "") {
        var result = 1;
        for (var i = 0; i < line.length; i++) {
        	var numberOfOccurences = line.split(i).length - 1;
        	if (line[i] !=	 numberOfOccurences) {
        		result = 0;
        	}
        }
        console.log(result);
    }
});