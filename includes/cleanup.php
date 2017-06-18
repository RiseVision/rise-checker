<?php
	/**
	 * @author Jan
	 * @link https://github.com/lepetitjan/rise-checker
	 * @license https://github.com/lepetitjan/rise-checker/blob/master/LICENSE
	 */
	 
echo "[ LOGFILES ] \n";
echo "\t\t\tPerforming log rotation and cleanup...\n";
rotateLog($logfile, $max_logfiles, $logsize);

// Remove lock file
if(!unlink($lockfile)){
echo "[ LOCKFILE ] Unable to remove lock file!\n";
}