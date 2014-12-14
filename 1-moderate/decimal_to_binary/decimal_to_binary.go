package main

import (
	"fmt"
	"os"
	"bufio"
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
		fmt.Println(decimalToBinary(str))
	}
}

func decimalToBinary(input string) string {
	number, _ := strconv.Atoi(input)
	return strconv.FormatInt(int64(number), 2)
}