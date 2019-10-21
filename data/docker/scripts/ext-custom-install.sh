#!/bin/sh

DIR=$(dirname $0)
LOGFILE=${2:-/dev/null}

$DIR/ext-composer.php $1 | grep -v -f "${DIR}/ext-list.txt" | while read ext; do
  if [ -z "${ext}" ]; then continue; fi
  if ! [ -f "${DIR}/ext/${ext}.sh" ]; then continue; fi
  echo "      - ${ext}"
  $DIR/ext/${ext}.sh &>${LOGFILE} || { cat ${LOGFILE} ; exit 1 ; }
done
