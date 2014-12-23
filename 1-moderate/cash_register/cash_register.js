var bills = {
	'ONE HUNDRED': 10000, 'FIFTY': 5000, 'TWENTY': 2000, 'TEN': 1000, 
	'FIVE': 500, 'TWO': 200, 'ONE': 100, 'HALF DOLLAR': 50,
	'QUARTER': 25, 'DIME': 10, 'NICKEL': 05, 'PENNY': 01
}

var fs  = require("fs");

fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line != "") {
    	inputs = line.split(";");
    	var price = parseFloat(inputs[0]) * 100;
    	var cash  = parseFloat(inputs[1]) * 100;
    	var result = [];
    	var change = cash - price;
    	if (change === 0) {
    		result = "ZERO";
    	} else if (change < 0) {
    		result = "ERROR";
    	} else {
    		var residual = change;
    		for(var key in bills) {
	    		while (bills[key] <= residual) {
	    			result.push(key);
	    			residual -= bills[key]; 
	    		}
	    	}
	    	result = result.join(",");	
    	}
        console.log(result);
    }
});