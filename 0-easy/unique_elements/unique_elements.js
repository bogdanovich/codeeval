/*
* Challenge description:
* https://www.codeeval.com/open_challenges/29
*/

var fs  = require("fs");

function onlyUnique(value, index, self) { 
    return self.indexOf(value) === index;
}


fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line != "") {
        elements = line.split(",").map(function (element) {
        	return parseInt(element);
        });

        uniqueElements = elements.filter(onlyUnique).sort(function(a, b) {
  			return a - b;
		});

        answer_line = uniqueElements.join(",");
        console.log(answer_line);

    }
});

