package main

import (
	"fmt"
	"os"
	"bufio"
	"strconv"
)

func numberOfOnes(input string) int {
	number, _ := strconv.Atoi(input)
	binaryString := strconv.FormatInt(int64(number), 2)
	sum := 0
	for _, value := range binaryString {
		if string(value) == "1" {
			sum += 1
		}
		
	} 
	return sum
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
		fmt.Println(numberOfOnes(str))
	}
}