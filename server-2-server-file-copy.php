<?php 


$file = 'http://domain.com/file.zip';
$newfile = 'cdn.zip';

if ( copy($file, $newfile) ) {
  echo "Copy success!";
} else {
  echo "Copy failed.";
}



<?php 

$file       = 'http://domain.uk/assets.zip';
$newfile    = 'assets.zip';
echo (copy($file, $newfile)) ?  "assets.zip Copied" : "assets failed.";


$file       = 'http://domain.uk/codes.zip';
$newfile    = 'codes.zip';
echo ( copy($file, $newfile) ) ?  "codes.zip Copied" : "codes failed.";
sleep(1);


$file       = 'http://domain.uk/vendor.zip';
$newfile    = 'vendor.zip';

echo ( copy($file, $newfile) ) ?  "vendor.zip Copied" : "vendor failed.";
sleep(1);
