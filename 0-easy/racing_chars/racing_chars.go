package main

import "fmt"
import "log"
import "bufio"
import "os"
import "strings"

var replacement = map[int]string{
    0  : "|", 
    -1 :"/", 
    1: "\\",
}

type Race struct {
    carPosition int
}

func (r *Race) PrintSegment(segment string) {
    targetValue := "C"
    targetIndex := strings.Index(segment, targetValue)
    
    if targetIndex == -1 {
        targetValue = "_"
        targetIndex = strings.Index(segment, targetValue)
    }
    
    if r.carPosition < 0 {
        r.carPosition = targetIndex
    }

    segment = strings.Replace(segment, targetValue, replacement[targetIndex - r.carPosition], 1)
    r.carPosition = targetIndex
    fmt.Println(segment)
}

func main() {
    file, err := os.Open(os.Args[1])
    if err != nil {
        log.Fatal(err)
    }   
    defer file.Close()
    scanner := bufio.NewScanner(file)

    race := Race{-1}

    for scanner.Scan() {
        race.PrintSegment(scanner.Text())
    }   
}

