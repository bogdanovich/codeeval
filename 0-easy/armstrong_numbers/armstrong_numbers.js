/*
* Challenge description: 
* https://www.codeeval.com/open_challenges/82/
*/

var fs  = require("fs");
fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line !== "") {
        var n = line.length;
        var digits = line.split("");
        var result = 0;
        for(i = 0; i < n; i++) {
            result += Math.pow(parseInt(digits[i]), n);
        }
        result = (result == line) ? "True" : "False";
        console.log(result);
    }
});
