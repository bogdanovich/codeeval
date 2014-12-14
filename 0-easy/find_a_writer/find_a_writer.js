/*
* Challenge description:
* https://www.codeeval.com/open_challenges/97/
*/

var fs  = require("fs");
fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line !== "") {
        line = line.split("| ");
        var encoded = line[0];
        var key = line[1].split(" ");
        var authorName = [];
        for (var i = 0; i < key.length; i++) {
            authorName.push(encoded[key[i] - 1]);
        }

        console.log(authorName.join(""));
        
    }
});
