#!/bin/sh

find ./invhtml -name '*.html'
file=($(find ./invhtml -name '*.html'))

LF=$(printf '\\\012_')
LF=${LF%_}
for name in ${file[@]}; do
    sed -i -e "s/<\/head>/<script>${LF}alert('LFタグ！')${LF}<\/script>${LF}<\/head>/" ${name}
done
