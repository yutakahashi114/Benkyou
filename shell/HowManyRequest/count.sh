#!/bin/sh

cat sample.log | awk '{print $7;}' | grep -o '\.[a-zA-Z_]*$' | sort | uniq -c
