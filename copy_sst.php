<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
set_time_limit(18000); # 5 hr
define('DEBUG_MODE',  true);


/**
 *	Class to download big files in chunks and save them in a directory. Directory : /Y-m-d/
 **/
class download_class
{
    public $downloadDir;
    private $sourceFile;
    private $destinationFileName;
    private $CHUNK;
    private $retry;
    private $destinationFile;

    private $start;
    private $download_time;


    # constructor
    function __construct($params = array())
    {
        # set params
        if (isset($params['sourceFile']) AND isset($params['destinationFileName']) AND isset($params['destinationPath'])) {
            $this->sourceFile          = $params['sourceFile'];
            $this->destinationFileName = $params['destinationFileName'];
            $this->downloadDir = $params['destinationPath'];
        }


        # set CHUNK to be downloaded
        $this->CHUNK = 4194304; # 4MB at a time

    }


    # retrieve_remote_file_size
    function retrieve_remote_file_size()
    {

        if (!$this->sourceFile) {
            return false;
        }

        $ch = curl_init($this->sourceFile);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE);
        @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $data = curl_exec($ch);
        $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        #echo $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); # get http code

        curl_close($ch);
        return $size;
    }


    # write_log
    function write_log($content = '')
    {
        if (@DEBUG_MODE == true) {

            $somecontent = "[" . date('Y-m-d H:i:s') . "] " . $content . "\n\r";
            $filename    = $this->downloadDir . '/log.txt';
            $handle      = fopen($filename, 'a');
            fwrite($handle, $somecontent);
            fclose($handle);
        }
    }



    # download_file
    function download_file()
    {
        $return = array();

        if (empty($this->sourceFile) OR empty($this->destinationFileName)) {
            $return['status']  = 'error';
            $return['message'] = 'Invalid sourceFile OR destinationFileName';
        }
        $destinationFile = $this->downloadDir . '/' . $this->destinationFileName;
        # Start Time Counter
        $this->startTime();

        try {

            if (!($putData = fopen($this->sourceFile, "r")))
                throw new Exception("Can't get PUT data.");

            $tot_write = 0;


            if (!file_exists($this->downloadDir)) {
                mkdir($this->downloadDir, 0755, true); # check this on server, Server may have issue with creating dirs with specific file permissions.
            }

            // Create a temp file  OR Make File empty if already exists
            $fh = fopen($destinationFile, 'w');
            fwrite($fh, '');
            fclose($fh);


            // Open file for writing
            if (!($fp = fopen($destinationFile, "a")))
                throw new Exception("Can't write to tmp file");

            // Read the data a this->CHUNK at a time and write to the file
            while ($data = fread($putData, $this->CHUNK)) {
                $this->CHUNK_read = strlen($data);
                if (($block_write = fwrite($fp, $data)) != $this->CHUNK_read)
                    throw new Exception("Can't write more to tmp file");

                $tot_write += $block_write;
            }

            // Close file
            if (!fclose($fp))
                throw new Exception("Can't close tmp file");

            unset($putData);


            $remote_file_size = $this->retrieve_remote_file_size($this->sourceFile);
            $file_size        = filesize($destinationFile);


            // Check file length
            if ($file_size != $remote_file_size) {
                $this->retry = $this->retry + 1;

                # End Time Counter
                $this->endTime();

                # log
                $this->write_log('error :: Failed to download' . ' :: sourceFile: ' . $this->sourceFile . ' :: Execution Time in Seconds: ' . $this->download_time);


                if ($this->retry < 3) {
                    # Start Time Counter
                    $this->startTime();

                    # retry :: IMP = here return is neccessory else it'll not return anything to $obj method
                    return $this->download_file();
                } else {
                    throw new Exception("Wrong file size, Failed to download!");
                }

            } else {
                $this->destinationFile = $destinationFile;

                # success
                $return['status']  = 'success';
                $return['message'] = $destinationFile;

                # End Time Counter
                $this->endTime();
                $this->write_log($return['status'] . ' :: ' . $return['message'] . ' :: Download Time in Seconds: ' . $this->download_time);

            }


        }
        catch (Exception $e) {
            #echo '', $e->getMessage(), "\n";
            $return['status']  = 'error';
            $return['message'] = $e->getMessage();

            # End Time Counter
            $this->endTime();
            $this->write_log($return['status'] . ' :: ' . $return['message'] . ' :: sourceFile: ' . $this->sourceFile . ' :: Execution Time in Seconds: ' . $this->download_time);
        }

        return $return;
    }


    function startTime()
    {
        # count download startTime
        $time        = microtime();
        $time        = explode(' ', $time);
        $time        = $time[1] + $time[0];
        $this->start = $time;
    }

    function endTime()
    {
        if ($this->start) {
            # count download endTime
            $time   = microtime();
            $time   = explode(' ', $time);
            $time   = $time[1] + $time[0];
            $finish = $time;

            $download_time       = ($finish - $this->start);
            $this->download_time = round($download_time, 3); // For log.
        }
    }
}



$params = Array();
$params['sourceFile']          = 'https://xtomedicalhall.com/xtn_backup-21-9-21.zip';
$params['destinationFileName'] =  'xtn_backup-21-9-21.zip';
$params['destinationPath'] =  dirname(__FILE__) . '/'; #Current folder with a slash '/'

$obj    = new download_class($params);

if(!file_exists($params['destinationPath'].$params['destinationFileName'] ))
{
	$result = $obj->download_file();
	echo "File migrated successfully. Have Fun!";
}
else
{
	echo "File already exists";
}
