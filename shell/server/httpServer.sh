#!/bin/sh

while read line
do
    echo "LINE: $line"
    if [[ ${line} =~ (^GET .*$) ]]
    then
        file=$(echo ${line} | awk '{print $2;}' | tr -d '/')
        if [ -r $file ]
        then
            cat $file
        else
            echo "404: ${file} is not found"
        fi
    fi
done
