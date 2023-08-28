#!/bin/bash

csv_path=$1
output_file="output.txt"

# Your processing logic here...

for i in {1..100}; do
    output="Line $i processed." # Replace with your actual processing logic
    echo $output >> $output_file
    sleep 6 # Sleep for 6 seconds, simulate processing time
done

echo "Script completed!" >> $output_file

