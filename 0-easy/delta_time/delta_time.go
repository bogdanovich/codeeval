package main

import "fmt"
import "os"
import "bufio"
import "log"
import "strings"
import "time"

func main() {
    p := fmt.Println

    file, err := os.Open(os.Args[1])
    if err != nil {
        log.Fatal(err)
    }   
    defer file.Close()
    scanner := bufio.NewScanner(file)
    for scanner.Scan() {
        str := scanner.Text()
        times := strings.Split(str, " ")
        time1, _ := time.Parse("15:04:05", times[0]) 
        time2, _ := time.Parse("15:04:05", times[1])
        
        if time1.Unix() < time2.Unix() {
        	time1, time2 = time2, time1
        }
        duration := time1.Sub(time2).Seconds()
        diff := time.Unix(int64(duration), 0).UTC().Format("15:04:05")
        p(diff)
    }   
}