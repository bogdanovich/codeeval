var fs  = require("fs");

fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line != "") {
        var number = parseInt(line);
        var primes = [];
        for(var i = 0; i <= number; i++) {
            if (isPrime(i)) {
                primes.push(i);
            }
        }
        console.log(primes.join(","));
    }
});

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