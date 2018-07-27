#!/bin/bash
# installation script for linux for eCourse
# Author Luxus

# parameters 
# 1 mysql pwd


# First step setup db

if [ -z "$1" ]
  then
    echo "No Mysql password was provided, lets try without.";
    mysql -u root  < ./sql/buildecourse.sql
    if [ "$?" -eq 0 ]
   then
    echo "eCourse db sucessfully setup"
  else
    echo "problem with eCourse db setup."
  fi
else
#TODO considered insecure
mysql -u root -p$1 < ./sql/buildecourse.sql
    if [ "$?" -eq 0 ]
   then
    echo "eCourse db sucessfully setup"
  else
    echo "problem with eCourse db setup."
  fi

fi
