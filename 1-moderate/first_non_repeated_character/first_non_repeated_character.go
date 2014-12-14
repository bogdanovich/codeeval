package main

import (
	"fmt"
	"os"
	"bufio"
)

func firstNonRepeatedChar(str string) string {
	counter := make(map[uint8]int, len(str))
	for i := 0; i < len(str); i++ {
		counter[str[i]] += 1
	}
	for i := 0; i < len(str); i++ {
		if counter[str[i]] < 2 {
			return str[i:i+1]
		}
	}
	return "z"
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
		fmt.Println(firstNonRepeatedChar(str))
	}
}