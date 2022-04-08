# Export Single Database
timestamp="$(date '+%Y-%m-%d-%H-%M')"
sql_file="bonikmart-$timestamp.sql"
zip_file="bonikmart-$timestamp.zip"
mysqldump -u db_user_or_cp_user --password='db_pass' db_name > "/path/to/dir/$sql_file"
# Zip Database 
zip -q "/path/to/dir/$zip_file" "/path/to/dir/$sql_file"
# Send Mail with attach database.zip file
mail -s "Email Subject Backup at ${timestamp}" -a "/path/to/dir/$zip_file" skyview059@gmail.com<<EOF
Bonik Mart DB File
EOF
# Remove Temp Files after task complete
rm -f "/path/to/dir/$zip_file" "/path/to/dir/$sql_file"
echo "Backup Completed As DB of ${timestamp}"
