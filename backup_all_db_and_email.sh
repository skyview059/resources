echo "show databases;" | /usr/bin/mysql -u CP_User --password='CP_Pass' | grep -Ev "^(Database|mysql|performance_schema|information_schema)" | while read databasename
do
  echo dumping $databasename
  mysqldump -u CP_User --password='CP_Pass' "$databasename" > /path/to/db_backups/db/"$databasename.sql" 
done
zip -r /path/to/db_backups/db.zip /path/to/db_backups/db/
mail -s "All in One Database Back Email" -a /path/to/db_backups/db.zip skyview059@gmail.com<<EOF
        Download File Attachment or Save on Google Drive
EOF
rm -rf /path/to/db_backups/db/
rm -f /path/to/db_backups/db.zip
mkdir /path/to/db_backups/db
