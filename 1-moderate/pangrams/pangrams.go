package main

import (
	"fmt"
	"os"
	"bufio"
	"strings"
	"bytes"
)

func main() {
	file, err := os.Open(os.Args[1])
	if err != nil {
		panic(err)
	}
	defer file.Close()

	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		str := scanner.Text()
		fmt.Println(pangram(str))
	}
}

func pangram(input string) string {
	
	lettersArray := strings.Split("abcdefghijklmnopqrstuvwxyz", "")
	
	input = strings.ToLower(input)
	var buffer bytes.Buffer
	for _, letter := range lettersArray {
		if !strings.Contains(input, letter) {
			buffer.WriteString(letter)
		}
	}

	result := buffer.String()
	if result != "" {
		return result
	} else {
		return "NULL"
	}
}

