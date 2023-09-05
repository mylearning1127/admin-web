#!/bin/bash
LOG_FILE="script.log"

log_event() {
  local current_time
  current_time=$(date +"%Y-%m-%d %H:%M:%S")
  echo "[$current_time] $1"
  echo "[$current_time] $1" >> "$LOG_FILE"
}

log_event $1
log_event $2
log_event $3
log_event $4
log_event $5
#date -d "$4" +%Y-%m-%d
#date -d "$5" +%Y-%m-%d

date=$(date +"%Y-%m-%d %H:%M:%S")

echo "Line 1"
echo "Line 2"

log_event "[INFO]: executed on $date"
for ((i = 1; i <= 3; i++)); do
log_event "[INFO]: execution success $i"
sleep 60s
done

