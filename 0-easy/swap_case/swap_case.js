/*
* Challenge description:
* https://www.codeeval.com/open_challenges/96
*/

var fs  = require("fs");
fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line !== "") {
        var swapCaseLine = "";
        for(var i = 0; i < line.length; i++) {
            if (line[i] == line[i].toUpperCase()) {
                swapCaseLine += line[i].toLowerCase();
            } else {
                swapCaseLine += line[i].toUpperCase();
            }
        }
        console.log(swapCaseLine);
        
    }
});
