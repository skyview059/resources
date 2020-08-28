# Export Database
mysqldump DB_NAME -uDB_USER -pDB_PASS > "/path/to/sql/file/db.sql"
# Zip Database 
zip -q /path/to/sql/file/db.zip /path/to/sql/file/db.sql
# Send Mail with attach database.zip file
mail -s "SamSon Assessment" -a /path/to/sql/file/db.zip your@mail.com<<EOF
Download File Attachment or Save on Google Drive
EOF
# Remove Temp Files after task complete
rm -f /path/to/sql/file/db.zip /path/to/sql/file/db.sql
