#!/bin/bash

cd /var/www/html
git add -A
git commit -m "Committed automatically through script on $(date +'%m/%d/%Y-%T')"
git push
