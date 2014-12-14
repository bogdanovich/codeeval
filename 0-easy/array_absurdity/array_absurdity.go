package main

import (
	"fmt"
	"os"
	"bufio"
	"strings"
	"strconv"
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
		fmt.Println(getResult(str))
	}
}

func getResult(input string) string {
	inputs := strings.Split(input, ";")
	size, _ := strconv.Atoi(inputs[0])
	arr := make(map[string]int, size)
	numbers := strings.Split(inputs[1], ",")
	for _, number := range numbers {
		if arr[number] > 0 {
			return number
		}
		arr[number] += 1
	}
	return "NONE"
}

