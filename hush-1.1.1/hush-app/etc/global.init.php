<?php
/**
 * Global settings
 */
$GLOBALS['LIB']['HUSH'] = 'http://code.gameplus.sdo.com/HushFramework-1.1.0.zip';
$GLOBALS['LIB']['ZEND'] = 'http://code.gameplus.sdo.com/ZendFramework-1.12.3.zip';
$GLOBALS['LIB']['SMARTY2'] = 'http://code.gameplus.sdo.com/Smarty-2.6.27.zip';
$GLOBALS['LIB']['SMARTY3'] = 'http://code.gameplus.sdo.com/Smarty-3.1.14.zip';
$GLOBALS['LIB']['PHPDOC'] = 'http://code.gameplus.sdo.com/Phpdoc-stable.zip';

/**
 * Global checking
 */
if (!class_exists('ZipArchive')) {
	echo "Please install zip extension for PHP\n";
	exit;
}

/**
 * Global initialization
 */
if (defined('__HUSH_CLI')) {
	
	// check path
	if (!is_dir(__COMM_LIB_DIR)) {
		mkdir(__COMM_LIB_DIR, 0777, true);
	}
	if (!is_dir(__HUSH_LIB_DIR)) {
		mkdir(__HUSH_LIB_DIR, 0777, true);
	}
	
	// check core libraries
	$hushDir = __HUSH_LIB_DIR . DIRECTORY_SEPARATOR . 'Hush';
	if (!is_dir($hushDir)) {
		// download Hush Framework
		echo "\nInstalling Hush Framework .. \n";
		$downFile = $GLOBALS['LIB']['HUSH'];
		$saveFile = __HUSH_LIB_DIR . DIRECTORY_SEPARATOR . 'HushFramework.zip';
		$savePath = __HUSH_LIB_DIR . DIRECTORY_SEPARATOR . '.';
		if (_hush_download($downFile, $saveFile)) {
			echo "Extracting.. ";
			$zip = new ZipArchive;
			$zip->open($saveFile);
			$zip->extractTo($savePath);
			$zip->close();
			unset($zip);
			echo "Done!\n";
		}
	}
}
else {
	
	// check other libraries
	$hushDir = __HUSH_LIB_DIR . DIRECTORY_SEPARATOR . 'Hush';
	$zendDir = __COMM_LIB_DIR . DIRECTORY_SEPARATOR . 'Zend';
	if (!is_dir($hushDir) || !is_dir($zendDir)) {
		echo "Core libraries can not be found .. <br/>\n";
		echo "1. If database EXISTED, Please enter 'hush_app/bin' and execute 'hush sys uplib' command.<br/>\n";
		echo "2. If database NO-EXISTED, Please enter 'hush_app/bin' and execute 'hush sys init' command.<br/>\n";
		exit(1);
	}
}