package main

import (
    "fmt"
    "os"
    "bufio"
    "log"
    "strings"
    "strconv"
)

var monthToNumber = map[string]int {
    "Jan": 0, "Feb": 1, "Mar": 2, "Apr": 3, "May": 4, "Jun": 5, 
    "Jul": 6, "Aug": 7, "Sep": 8, "Oct": 9, "Nov": 10, "Dec": 11,
}

func monthIndex(date string) int {
    monthDate := strings.Split(date, " ")
    year, _ := strconv.Atoi(monthDate[1])
    return (year - 1990) * 12 + monthToNumber[monthDate[0]]
}

func fillInterval(monthFlags []int, interval string) {
    dates := strings.Split(interval, "-")
    startIndex := monthIndex(dates[0])
    endIndex := monthIndex(dates[1])
    for i:= startIndex; i <= endIndex; i++ {
        monthFlags[i] = 1
    }
}  

func workingExperience(input string) int {
    intervals := strings.Split(input, "; ")
    monthFlags := make([]int, 372)
    //fmt.Println(monthFlags)

    for i:= range intervals {
        fillInterval(monthFlags, intervals[i])
    }

    sum := 0
    for i:= range monthFlags {
        sum += monthFlags[i]
    }

    return sum / 12
}

func main() {
    file, err := os.Open(os.Args[1])
    if err != nil {
        log.Fatal(err)
    }   
    defer file.Close()
    scanner := bufio.NewScanner(file)
    for scanner.Scan() {
        str := scanner.Text()
        fmt.Println(workingExperience(str))
    }   
}