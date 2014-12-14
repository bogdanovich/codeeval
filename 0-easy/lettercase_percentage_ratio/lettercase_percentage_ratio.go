package main

import "fmt"
import "log"
import "bufio"
import "os"

func main() {
    file, err := os.Open(os.Args[1])
    if err != nil {
        log.Fatal(err)
    }   
    defer file.Close()
    scanner := bufio.NewScanner(file)
    for scanner.Scan() {
        str := scanner.Text()
        lowercase, uppercase := 0,0
        
        for _, code := range str {
            if code >= 97 {
                lowercase += 1
            } else {
                uppercase += 1
            }
        }
        lowercasePercent := float64(lowercase) / float64(len(str)) * 100
        uppercasePercent := float64(uppercase) / float64(len(str)) * 100
        fmt.Printf("lowercase: %.2f uppercase: %.2f\n", lowercasePercent, uppercasePercent)
    }   
}