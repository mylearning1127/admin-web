#!/bin/bash

echo "############################################"
echo "               Launching scipt   NEW           "
echo "############################################"
date=$(date)

echo "Line 1"
echo "Line 2"

echo "executed on $date"
for ((i = 1; i <= 10; i++)); do
    echo $i
sleep 1s
done

