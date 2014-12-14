package main

import (
	"fmt"
	"os"
	"bufio"
	"strings"
)

func removeCharacters(input string) string {
	inputs := strings.Split(input, ", ")

	scrub := func(r rune) rune {
		if strings.ContainsRune(inputs[1], r) {
			return -1
		}
		return r
	}

	return strings.Map(scrub, inputs[0])
}

func main() {
	file, err := os.Open(os.Args[1])
	if err != nil {
		panic(err)
	}
	defer file.Close()

	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		str := scanner.Text()
		fmt.Println(removeCharacters(str))
	}
}