/*
* Challenge description:
* https://www.codeeval.com/open_challenges/31
*/

var fs  = require("fs");
fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line != "") {
        var input = line.split(",");
        console.log(input[0].lastIndexOf(input[1]));
    }
});