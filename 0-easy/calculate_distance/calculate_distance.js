/*
* Challenge description:
* https://www.codeeval.com/open_challenges/99/
*/

var fs  = require("fs");
fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line !== "") {
        var coords = line.replace(/\(|\)|,/g, "").split(" ");
        var distance = Math.sqrt(Math.pow(coords[0] - coords[2], 2) + Math.pow(coords[1] - coords[3], 2));
        console.log(distance);
    }
});
