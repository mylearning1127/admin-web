#!/bin/bash

echo $1
echo $2
echo $3

date=$(date +"%Y-%m-%d %H:%M:%S")

echo "Line 1"
echo "Line 2"

echo "[$date] [INFO]: executed on $date"
for ((i = 1; i <= 5; i++)); do
    echo $i
sleep 1s
done

