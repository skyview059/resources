<?php 


$file = 'http://domain.com/file.zip';
$newfile = 'cdn.zip';

if ( copy($file, $newfile) ) {
  echo "Copy success!";
} else {
  echo "Copy failed.";
}
