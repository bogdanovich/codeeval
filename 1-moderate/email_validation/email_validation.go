package main

import (
	"fmt"
	"os"
	"bufio"
	"regexp"
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
		fmt.Println(emailValidation(str))
	}
}

func emailValidation(input string) string {
	match, _ := regexp.MatchString(`^[\w\.=-]+@[\w\.-]+\.[\w]{2,3}$`, input)
	return strconv.FormatBool(match)
}