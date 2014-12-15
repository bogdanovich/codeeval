package main

import (
	"fmt"
	"os"
	"bufio"
	"strings"
	"strconv"
)

func check(err error) {
	if err != nil {
		panic(err)
	}
}

var queryBoard [256][256]int

func query(query string) {
	queryParams := strings.Split(query, " ")
	key, _ := strconv.Atoi(queryParams[1])
	switch queryParams[0] {
	case "SetRow":
		value, _ := strconv.Atoi(queryParams[2])
		for i := 0; i < 256; i++ {
			queryBoard[key][i] = value
		}
	case "SetCol":
		value, _ := strconv.Atoi(queryParams[2])
		for i := 0; i < 256; i++ {
			queryBoard[i][key] = value
		}
	case "QueryRow":
		sum := 0
		for i := 0; i < 256; i++ {
			sum += queryBoard[key][i]
		}
		fmt.Println(strconv.Itoa(sum))
	case "QueryCol":
		sum := 0
		for i := 0; i < 256; i++ {
			sum += queryBoard[i][key]
		}
		fmt.Println(strconv.Itoa(sum))
	}
}

func main() {
	file, err := os.Open(os.Args[1])
	check(err)
	defer file.Close()

	
	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		str := strings.TrimSpace(scanner.Text())
		query(str)
	}
}