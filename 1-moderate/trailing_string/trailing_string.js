var fs  = require("fs");

fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line != "") {
        inputs = line.split(",");
        console.log((inputs[0].slice(-inputs[1].length) === inputs[1]) ? 1 : 0);
    }
});