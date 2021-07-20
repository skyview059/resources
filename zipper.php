<?php 

$token = isset( $_GET['token']) ? $_GET['token'] : false;

if($token == false) { die( 'No Token Found ' ); }

$key = date('dmy');
if($token !==  $key) { die( 'Token Not Match' ); }




$siteName 	= 'http://stevewoodremovals.co.uk/';
$folderName = 'SWR_Bakup';

//die('Change folder name before start new zip.');

//$rootPath = realpath( 'wp-content' ) ;
$rootPath = __DIR__;

// Initialize archive object
$zip = new ZipArchive();
$zip->open( $folderName . '.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file){
    // Skip directories (they would be added automatically)
    if (!$file->isDir()){
        // Get real and relative path for current file
        $filePath 		= $file->getRealPath();
        $relativePath 	= substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();

$link = $siteName . $folderName . '.zip';


echo "<a href='{$link}'> Download File || {$link}  </a>";

