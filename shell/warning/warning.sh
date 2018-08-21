#!/bin/sh

capacity=$(sh oredf.sh | awk '{print $5;}' | sed -e 's/\([0-9]\{1,3\}\)%$/ \1/' | sed -n 2p)

while [ !${capacity} -ge 80 ]
do
    capacity=$(sh oredf.sh | awk '{print $5;}' | sed -e 's/\([0-9]\{1,3\}\)%$/ \1/' | sed -n 2p)
done
echo 'warning'
