package main

import (
	"fmt"
	"os"
	"bufio"
	"strings"
	"strconv"
)

var p = fmt.Println

func main() {
	file, err := os.Open(os.Args[1])
	if err != nil {
		panic(err)
	}
	defer file.Close()

	scanner := bufio.NewScanner(file)
	for i := 1; scanner.Scan(); i++ {
		str := scanner.Text()
		fmt.Println(getResult(str))
	}
}

func getResult(input string) string {
	inputs := strings.Split(input, ",")
	numbers := make([]int, len(inputs))
	for i, value := range inputs {
		numbers[i], _ = strconv.Atoi(value)
	}

	maxSum := -999999999999999999
	for i := 0;  i < len(numbers); i++ {
		sum := 0
		for j := i; j < len(numbers); j++ {
			sum += numbers[j]
			if sum > maxSum {
				maxSum = sum
			}
		}
		
	}

	return strconv.Itoa(maxSum)
}

