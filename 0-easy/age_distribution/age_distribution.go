package main

import "fmt"
import "log"
import "bufio"
import "os"
import "strconv"

func main() {
    file, err := os.Open(os.Args[1])
    if err != nil {
        log.Fatal(err)
    }   
    defer file.Close()
    scanner := bufio.NewScanner(file)
    for scanner.Scan() {
        
        age, err := strconv.ParseInt(scanner.Text(), 10, 0)

        if err != nil {
        	panic("Error parsing string")
        }

        switch {
        case age < 0 || age > 100:
        	fmt.Println("This program is for humans")
        case age <= 2:
        	fmt.Println("Still in Mama's arms")
        case age <= 4:
        	fmt.Println("Preschool Maniac")
        case age <= 11:
        	fmt.Println("Elementary school")
        case age <= 14:
        	fmt.Println("Middle school")
        case age <= 18:
        	fmt.Println("High school")
        case age <= 22 :
        	fmt.Println("College")
        case age <= 65:
        	fmt.Println("Working for the man")
        case age <= 100:
        	fmt.Println("The Golden Years")
        }

    }   
}