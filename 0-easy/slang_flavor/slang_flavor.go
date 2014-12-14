package main

import (
	"fmt"
	"os"
	"io/ioutil"
	"bytes"
)

func check(e error) {
    if e != nil {
        panic(e)
    }
}

var replacements = []string{
	", yeah!", ", this is crazy, I tell ya.", ", can U believe this?", 
	", eh?", ", aw yea.", ", yo.", "? No way!", ". Awesome!",
}

func slangFlavor(text string) string {
	everyOther := false
	i := 0
	var buffer bytes.Buffer
	
	for _, byte := range text {
		char := string(byte)
		if char == "." || char == "?" || char == "!" {
			if everyOther {
				buffer.WriteString(replacements[i])
				i = (i + 1) % len(replacements)
			} else {
				buffer.WriteString(char)	
			}
			everyOther = !everyOther
		} else {
			buffer.WriteString(char)
		}
	}
	return buffer.String()
}

func main() {
	text, err := ioutil.ReadFile(os.Args[1])
	check(err)
	fmt.Println(slangFlavor(string(text)))
}