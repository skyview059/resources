<?php 

/*
cron job setup guide
wget -O - http://domain.com/cleanup.php >/dev/null 2>&1	
*/

$dir    = '/path/to/dir/sessions/';
$files  = array_diff(scandir($dir), array('.', '..'));

foreach ($files as $file){
    echo "Deleted: {$dir}/{$file}" . "<br/>";
    @unlink("$dir/$file");
}
