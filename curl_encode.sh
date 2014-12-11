#!/bin/bash
data=`cat data.json.encode`
curl -v -d   "${data}"  "http://nvrenbang.com/api/base?isEncrypt=1"
