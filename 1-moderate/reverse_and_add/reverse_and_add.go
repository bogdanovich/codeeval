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
		fmt.Println(reverseAdd(str))
	}
}

func reverseAdd(input string) string {
	
	number, _ := strconv.Atoi(input)
	reverseNumber, _ := strconv.Atoi(Reverse(input))	
	sum := number + reverseNumber
	i:= 1
	if !isPalindrome(strconv.Itoa(sum)) {
		for i = 2; i < 100; i++ {
			sumReverse, _ := strconv.Atoi(Reverse(strconv.Itoa(sum)))
			sum += sumReverse
			if isPalindrome(strconv.Itoa(sum)) {
				break
			}
		}	
	}
	return fmt.Sprintf("%d %d", i, sum)
}

func Reverse(s string) string {
    runes := []rune(s)
    for i, j := 0, len(runes)-1; i < j; i, j = i+1, j-1 {
        runes[i], runes[j] = runes[j], runes[i]
    }
    return string(runes)
}

func isPalindrome(input string) bool {
	if input == Reverse(input) {
		return true
	}
	return false
}