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
    exit 1
  fi
else
#TODO considered insecure
mysql -u root -p$1 < ./sql/buildecourse.sql
    if [ "$?" -eq 0 ]
   then
    echo "eCourse db sucessfully setup"
  else
    echo "problem with eCourse db setup."
    exit 1;
  fi

fi

if [ -d $DIR ]; then
  echo "eCourse directory already exists. Please delete first";
  
   read -p 'Would you like to delete it (y/n)? ' DELDIR;
  if [ ${DELDIR,,} == 'y' ] ; then
    rm -rdf $DIR;
   if [ "$?" -eq 0 ]
   then
    echo "eCourse directory deletion successful"
  else
    echo "problem with eCourse directory deletion"
    exit 1;
  fi
   
   
  else
  echo " Please remove directory manually and restart installation"
  exit 1;
  fi
 else
 mkdir $DIR
   if [ "$?" -eq 0 ]
   then
    echo "eCourse directory sucessfully setup"
  else
    echo "problem with eCourse directory creation."
    exit 1;
  fi

fi

rsync -avz --exclude 'install.sh' --exclude 'sql/buildecourse.sql' --exclude '.git' . $DIR
 if [ "$?" -eq 0 ]
   then
    echo "eCourse copied to webserver location sucessfully setup"
  else
    echo "problem with copying eCourse to webserver location."
    exit 1;
  fi

# install composer
cd $DIR;

./install_composer.sh
 if [ "$?" -eq 0 ]
   then
    echo "download composer successful"
  else
    echo "download composer failed."
    exit 1;
  fi

 php composer.phar install
  if [ "$?" -eq 0 ]
   then
    echo "composer sucessfully setup"
  else
    echo "problem with composer setup"
    exit 1;
  fi

#echo "composer installed, including depenencies"

# start webservice
# php -S localhost:3000
