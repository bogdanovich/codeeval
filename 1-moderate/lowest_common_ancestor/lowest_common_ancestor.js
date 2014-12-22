var tree = [30, 8, 52, 3, 20, null, null, null, null, 10, 29];

var fs  = require("fs");

fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line != "") {
        inputs = line.split(" ");
        i = tree.indexOf(parseInt(inputs[0]));
        j = tree.indexOf(parseInt(inputs[1]));
        k = lowestCommonAncestor(i, j);
        console.log(tree[k]);
    }
});

function lowestCommonAncestor(i, j) {
	if (i === j) {
		return i;
	} else if (i > j) {
		return lowestCommonAncestor(Math.floor((i - 1) / 2), j);
	} else if (i < j) {
		return lowestCommonAncestor(i, Math.floor((j - 1) / 2));
	}
}