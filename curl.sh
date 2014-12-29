#!/bin/bash
data=`cat data.json`
curl -v -d   "${data}"  "http://app.zaofenxiang.com/api/base"
