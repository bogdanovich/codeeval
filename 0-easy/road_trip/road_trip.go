package main

import (
	"fmt"
	"os"
	"bufio"
	"strings"
	"strconv"
	"sort"
)

func check(err error) {
	if err != nil {
		panic(err)
	}
}

func main() {
	file, err := os.Open(os.Args[1])
	check(err)
	defer file.Close()

	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		str := scanner.Text()
		cities := strings.Split(str, ";")
		var distances []int
		var distance int
		for _, city := range cities {
			if city != "" {
				cityInfo := strings.Split(city, ",")
				distance, _ = strconv.Atoi(cityInfo[1])
				distances = append(distances, distance)	
			}
		}
		sort.Ints(distances)
		var result []string
		result = append(result, strconv.Itoa(distances[0]))
		for i := 1; i < len(distances); i++ {
			result = append(result, strconv.Itoa(distances[i] - distances[i - 1]))
		}
	 	fmt.Println(strings.Join(result, ","))
	}
}