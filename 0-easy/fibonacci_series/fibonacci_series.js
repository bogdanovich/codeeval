/*
* Challenge description:
* https://www.codeeval.com/open_challenges/22/
*/

var fs  = require("fs");

function fib(n) {
	if (n === 0) {
		return 0;
	}
	if (n === 1) {
		return 1;
	}
	return fib(n - 1) + fib(n - 2);
}

fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line != "") {
        answer_line = fib(parseInt(line));
        console.log(answer_line);

        var stats = fs.statSync(process.argv[2]);
 		var fileSizeInBytes = stats["size"];
 		console.log(fileSizeInBytes);
    }
});

