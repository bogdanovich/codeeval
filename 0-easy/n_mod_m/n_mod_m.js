/*
* Challenge description:
* https://www.codeeval.com/open_challenges/62
*/

var fs  = require("fs");
fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line !== "") {
        var numbers;
        numbers = line.split(",");
        var a = parseInt(numbers[0]);
        var b = parseInt(numbers[1]);
        if (a < b) {
            result = a;
        } else {
            while(a >= b && a != 0) {
                a = a - b;
            }
            result = a;
        }

        console.log(result);
    }
});