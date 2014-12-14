/*
* Challenge description:
* https://www.codeeval.com/open_challenges/30
*/

var fs  = require("fs");

function arrayIntersection(a, b) {
    return a.filter(function(n) {
        return b.indexOf(n) != -1;
    })
}

fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line != "") {

        var sets = line.split(";").map(function(el) {
            return el.split(",");
        });
        
        var intersection = arrayIntersection(sets[0], sets[1]);
        console.log(intersection.join(","));

    }
});

