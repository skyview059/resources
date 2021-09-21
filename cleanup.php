<?php 


$dir    = '/path/to/dir/sessions/';
$files  = array_diff(scandir($dir), array('.', '..'));

foreach ($files as $file){
    echo "Deleted: {$dir}/{$file}" . "<br/>";
    @unlink("$dir/$file");
}
