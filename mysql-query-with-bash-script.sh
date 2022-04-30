#!/bin/bash
#mysql -h <host> -u<user> -p<password> <db_name> -e \
mysql -h localhost -uDB_USER -pXXXXXX DB_NAME -e \
  "TRUNCATE ci_sessions;"
