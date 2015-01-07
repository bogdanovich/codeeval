// Array Remove - By John Resig (MIT Licensed)
Array.prototype.remove = function(from, to) {
  var rest = this.slice((to || from) + 1 || this.length);
  this.length = from < 0 ? this.length + from : from;
  return this.push.apply(this, rest);
};

var fs = require('fs');

fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function(line) {
	if (line != '') {
		console.log(flavius_josephus(line));
	}
});

function flavius_josephus(input) {
	var inputs = input.split(',').map(function(element) {
		return parseInt(element);
	});
	var arr = Array.apply(null, Array(inputs[0])).map(function(element, i) { return i; });
	var n = inputs[1];

	var i,j, result;
	i = j = 0;
	result = [];
	while(arr.length > 0) {
		if ((i + 1) % n === 0) {
			result.push(arr[j]);
			arr.remove(j);
		} else {
			j += 1;
		}
		i += 1;
		if (j >= arr.length)
			j = 0;
	}

	return result.join(" ");
}


