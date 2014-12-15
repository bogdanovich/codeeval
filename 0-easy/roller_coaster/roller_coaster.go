package main

import (
	"fmt"
	"os"
	"bufio"
	"unicode"
)

func check(e error) {
	if e != nil {
		panic(e)
	}
}

func getResult(text string) string {
	runes := []rune(text)
	convertToUpper := true
	for i, char := range runes {
		if unicode.IsLetter(char) {
			if convertToUpper {
				runes[i] = unicode.ToUpper(char)
			}
			convertToUpper = !convertToUpper
		}
	}
	return string(runes)
}

func main() {
	file, err := os.Open(os.Args[1])
	check(err)
	defer file.Close()

	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		str := scanner.Text()
		fmt.Println(getResult(str))
	}
}