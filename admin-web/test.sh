#!/bin/bash


success=9
failed=5
Implementation=10

for i in {1..40}; do

success=$($success+5)
failed=$($failed+1)
Implementation=$($Implementation+3)

echo $success, $failed, $Implementation

done
