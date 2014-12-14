/*
* Challenge description:
* https://www.codeeval.com/open_challenges/21
*/

var fs  = require("fs");
fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line != "") {
        sum = 0;
        for(i = 0; i < line.length; i++) {
        	sum += parseInt(line[i]);
        }
        answer_line = sum;
        console.log(answer_line);
    }
});