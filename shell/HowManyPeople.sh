#!/bin/sh

cd /
ls -l| awk '{print $4;}' | sort | uniq | grep -v '^\s*$' | wc -l
