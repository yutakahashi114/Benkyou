#!/bin/sh


while read line
do
    if [[ ${line} =~ (^GET .*$) ]]
    then
        file=$(echo ${line} | awk '{print $2;}' | tr -d '/')
        if [ -r $file ]
        then
            type=$(echo ${line} | awk '{print $3;}')
            if [[ ${type} =~ (^HTTP/1\.0$) ]]
            then
                date=$(date -u -R)
                content=$(cat ${file})
                filesize=$(wc -c ${file} | awk '{print $1}')

header="${type} 200 OK
Date: ${date}
Cache-Contral: no-store
Cantent-Type: text/html
Content-Language: en
Content-Length: ${filesize}"

                cat << EOS

${header}

${content}
EOS
            else
                echo "bad protocol"
            fi
        else
            echo "404: ${file} is not found"
        fi
    fi
done
