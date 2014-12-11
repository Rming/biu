#!/bin/bash
data=`cat data.json`
curl -v -d   "${data}"  "http://nvrenbang.com/api/base"
