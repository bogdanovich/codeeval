var fs  = require("fs");

fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line != "") {
        console.log(getResult(line));
    }
});

function getResult(line) {
    var inputs = line.split(",").map(function(el) {
        return parseInt(el);
    });

    return countPrimesBetween(inputs[0], inputs[1]);
}

function countPrimesBetween(a, b) {
    var counter = 0;
    for(var i = a; i <= b; i++) {
        if (isPrime(i)) {
            counter += 1;
        }
    }
    return counter;
}

function isPrime(number) {
    if (number <= 1) {
        return false;
    }
    var limit = Math.floor(Math.sqrt(number));
    for(var i = 2; i <= limit; i++) {
        if (number % i === 0) {
            return false;
        }   
    }
    return true;
}