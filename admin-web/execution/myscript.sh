#!/bin/bash

date=`date`
# Rest of your script
echo "Line 1"
echo "Line 2"
echo "Line 3"

echo "executed on $date"
for ((i = 1; i <= 5; i++)); do
    echo $i
    sleep 2s
done

exit

