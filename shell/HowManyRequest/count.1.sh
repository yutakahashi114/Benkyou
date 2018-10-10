#!/bin/sh

cat sample.log | awk '{print $7;}' | grep -o '\.[a-zA-Z]*$' | sort | uniq -c


array=($(cat sample.log | awk '{print $7;}' | grep -o '\.[a-zA-Z]*$' | sort | uniq ))
for expanded in "${array[@]}"
do
    count=$(cat sample.log | awk '{print $7;}' | grep $expanded | wc -l)
    echo $expanded $count
done


# cat sample.log | awk '{print $7;}' 
# echo $COUNT
