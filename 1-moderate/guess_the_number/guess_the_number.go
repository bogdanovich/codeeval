package main

import (
	"fmt"
	"os"
	"bufio"
	"strings"
	"strconv"
	"math"
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
		fmt.Println(guessTheNumber(str))
	}
}

func guessTheNumber(input string) string {
	inputs := strings.Split(input, " ")
	var min, max, guess float64
	min = 0.0
	max, _ = strconv.ParseFloat(inputs[0], 64)
	guess = math.Ceil((max - min) / 2.0)
	for _, answer := range inputs[1:] {
		switch answer {
			case "Higher":
				min = guess + 1
			case "Lower":
				max = guess - 1
			case "Yay!":
				break
		}
		guess = math.Ceil(min + (max - min) / 2.0)
	}
	return fmt.Sprintf("%.f", guess)
}