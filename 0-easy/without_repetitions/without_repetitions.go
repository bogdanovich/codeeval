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

func getResult(text string) string {
	var buffer bytes.Buffer
	buffer.WriteString(string(text[0]))
	for i := 1; i < len(text); i++ {
		if text[i] != text[i - 1] {
			buffer.WriteString(string(text[i]))
		}
	}
	return buffer.String()
}

func main() {
	bytes, err := ioutil.ReadFile(os.Args[1])
	check(err)
	text := string(bytes)
	fmt.Println(getResult(text))
}