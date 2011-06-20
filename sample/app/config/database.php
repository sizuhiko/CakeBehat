<?php
class DATABASE_CONFIG {

	var $development = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => 'root',
		'database' => 'cakebehat',
		'encoding' => 'utf8'
	);

    var $test = array(
    	'driver' => 'mysql',
    	'persistent' => false,
    	'host' => 'localhost',
    	'login' => 'root',
    	'password' => 'root',
    	'database' => 'cakebehat_test',
    	'encoding' => 'utf8'
    );
    
    var $default = array();

    function __construct() {
        $this->default = ($_SERVER['SERVER_NAME'] != 'test.localhost') ?
            $this->development : $this->test;
    }
    function DATABASE_CONFIG() {
        $this->__construct();
    }
}
?>