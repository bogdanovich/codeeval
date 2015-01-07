var fs  = require("fs");

fs.readFileSync(process.argv[2]).toString().split('\n').forEach(function (line) {
    if (line != "") {
        //console.log(line);
        //console.log(line + " " + checkParentheses(line));
        console.log(checkParentheses(line));
    }
});

function checkParentheses(line) {
    var stack = [];
    for(var i = 0; i < line.length; i++) {
        //console.log(stack);
        switch(line[i]) {
            case '(':
            case '[':
            case '{':
                stack.push(line[i]);
                break;
            case ')':
                if(stack.pop() != '(')
                    return 'False';
                break;
            case ']':
                if(stack.pop() != '[')
                    return 'False';
                break;
            case '}':
                if(stack.pop() != '{')
                    return 'False';
                break;
                
        }
    }
    if (stack.length > 0) {
        return 'False'
    }
    return 'True'
}
