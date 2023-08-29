#!/bin/bash

# Rest of your script
echo "Line 1"
flush
echo "Line 2"
flush
echo "Line 3"
flush

for ((i = 1; i <= 100; i++)); do

echo $i

sleep 2s

done

