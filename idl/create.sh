#!/bin/sh
_CUR_DIR=$(readlink -m $(dirname $0))
cd ${_CUR_DIR}

# check duplicate service|enum|struct name
duplicateName=`awk '/^(service|enum|struct).+/ { sub("( |\r$|{.*$)", "", $2);print $2}' ./allThriftFiles/*.thrift | sort | uniq -c | awk '{if($1 !~ 1) print $2}'`
if [ ! -z "${duplicateName}" ]
then
    echo ${duplicateName} "appear more than once, please check it!"
    exit 1
fi

duplicateFile=`find ./ -name "*.thrift" |sed 's#.*/##'| sort | uniq -c | awk '{if($1 !~ 1) print $2}'`
if [ ! -z "${duplicateFile}" ]
then
    echo ${duplicateFile} "appear more than once, please check it!"
    exit 1
fi

rm -rf gen-php && rm -rf gen-java && rm -rf gen-cocoa && rm -rf gen-html && rm -rf gen-json && rm -rf gen-autotest-java

apiFiles=()
struFiles=()

for i in `ls ./allThriftFiles/*.thrift`
do
    if [[ "$i" =~ api.thrift$ ]]
    then
        apiFiles+=("$i")
    else
        struFiles+=("$i")
    fi
done

allApiFiles=("${apiFiles[@]}")
allStruFiles=("${struFiles[@]}")

# for i in `ls ./allThriftFiles/only-h5/*.thrift`
# do
#     if [[ "$i" =~ api.thrift$ ]]
#     then
#         allApiFiles+=("$i")
#     else
#         allStruFiles+=("$i")
#     fi
# done

function handlerFiles
{
    declare -a files=("${!1}")
    for i in "${files[@]}"
    do
        cmd="$2 $i"
        eval $cmd
    done
}

##gen-json
#handlerFiles allApiFiles[@] 'thrift -o ./ -strict -gen json'
#
##gen-html
#handlerFiles allApiFiles[@] 'thrift -o ./ -strict -gen html'
#handlerFiles allStruFiles[@] 'thrift -o ./ -strict -gen html'

#gen-php
handlerFiles allApiFiles[@] 'thrift -o ./ -strict -gen php:server'
handlerFiles allStruFiles[@] 'thrift  -o ./ -strict -gen php:server'

##gen-android
#handlerFiles apiFiles[@] 'thrift -o ./ -strict -gen java:android_legacy,skip_deprecated'
#handlerFiles struFiles[@] 'thrift -o ./ -strict -gen java:android_legacy,skip_deprecated'
#
##gen-ios
#handlerFiles apiFiles[@] 'thrift -o ./ -strict -gen cocoa:skip_deprecated'
#handlerFiles struFiles[@] 'thrift -o ./ -strict -gen cocoa:skip_deprecated'

#gen-autotest-java
#mkdir ./gen-autotest-java
#handlerFiles allApiFiles[@] 'thrift -out ./gen-autotest-java -strict -gen java:android_legacy'
#handlerFiles allStruFiles[@] 'thrift -out ./gen-autotest-java -strict -gen java:android_legacy'
