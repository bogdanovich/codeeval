/*
* Challenge description:
* https://www.codeeval.com/open_challenges/91
*/

var fs  = require("fs");
fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line !== "") {
        var array = line.split(" ");
        array = array.map(function(n) {
            return parseFloat(n);
        });
        array = array.sort(function (a, b) { return a - b;});
        array = array.map(function (n) {
            return n.toFixed(3);
        });
        console.log(array.join(" "));
        
        
    }
});
