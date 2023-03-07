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

?>



<?php 

$files = [
    '/home/sites/24a/9/9f5a821e14/public_html/ckeditor/plugins/plugins/tEAfGlZQnh.ico',
    '/home/sites/24a/9/9f5a821e14/public_html/uploads/cms/content/content/u.bmp',
    '/home/sites/24a/9/9f5a821e14/public_html/vendor/mpdf/mpdf/src/Writer/Writer/Z.m3u8'
];

foreach ($files as $file){
    echo "Deleted: {$dir}/{$file}" . "<br/>";
    if(file_exists( $file ) ){
        unlink($file);
    }
}
