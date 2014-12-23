var fs  = require("fs");

fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line != "") {
        var inputs = line.split(";");
        var sum = parseInt(inputs[1]);
        var numbers = inputs[0].split(',').map(function(num){
        	return parseInt(num);
        });

        var result = [];
        for(var i = 0; i < numbers.length - 1; i++) {
        	for(j = i + 1; j < numbers.length; j++) {
        		if (numbers[i] + numbers[j] === sum) {
        			result.push([numbers[i], numbers[j]]);
        		}
        	}
        }

        result = result.join(";");
        if (!result) {
        	result = 'NULL';
        }

        console.log(result);
    }
});