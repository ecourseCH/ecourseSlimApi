#!/bin/bash
# installation script for linux for eCourse
# Author Luxus

# parameters 
# 1 mysql pwd
# 2 install dir of files default /var/www/html/ecourse

#check input parameters

if [ -z "$2" ]
  then
   DIR="/var/www/html/ecourse";
echo "Directory set to " $DIR ;

else
  DIR=$2;
 echo "Directory set to " $DIR ;
fi


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

if [ -d "/var/www/ecourse" ]; then
  echo "eCourse directory already exists. Please delete first"
 else
 mkdir /var/www/ecourse
   if [ "$?" -eq 0 ]
   then
    echo "eCourse directory sucessfully setup"
  else
    echo "problem with eCourse directory creation."
  fi

fi

rsync -avz --exclude 'install.sh' --exclude 'sql/buildecourse.sql' --exclude '.git' . $DIR

