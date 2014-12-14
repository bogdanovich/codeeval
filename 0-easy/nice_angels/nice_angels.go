package main

import (
	"fmt"
	"os"
	"bufio"
	"strconv"
	"math"
	//"strings"
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
		fmt.Println(niceAngels(str))
	}
}

func niceAngels(input string) string {
	number, _ := strconv.ParseFloat(input, 64)
	grad := int(math.Floor(number))
	totalSeconds := int((number - float64(grad)) * 3600)
	minutes := int(totalSeconds / 60)
	seconds := totalSeconds % 60
	return  fmt.Sprintf("%d.%02d'%02d\"", grad, minutes, seconds)
}