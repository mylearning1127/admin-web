#!/bin/bash

# Your actual authentication logic here
# For this example, we're assuming success always
username=$1
passwd=$2

#echo $username $passwd
#result=`sshpass -p ${passwd} ssh ${username}@127.0.0.1 whoami`

#echo $result

if [[ ! -z $(cat /etc/passwd | grep -i $username) ]]; then

echo "pass"

fi
