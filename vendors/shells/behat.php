<?php

define('BEHAT_ROOT', VENDORS . 'Behat' . DS);
define('BEHAT_PHP_BIN_PATH',    '/usr/bin/env php');
define('BEHAT_BIN_PATH',        BEHAT_ROOT . 'bin/behat.php');
define('BEHAT_VERSION',         'DEV');
require_once BEHAT_ROOT . 'autoload.php.dist';
require_once VENDORS . 'mink.phar';

class BehatShell extends Shell {
    
    function main() {
        $this->_initDb();
        $this->_loadModels();

        $args = $_SERVER['argv'];
        do {
            array_shift($args);
        } while($args[0] != 'behat');

        // Internal encoding to utf8
        mb_internal_encoding('utf8');

        $app = new Behat\Behat\Console\BehatApplication(BEHAT_VERSION);
        
        $command_option = false;
        foreach($args as $option) {
            $option = str_replace("-", "", $option);
            if($app->getDefinition()->hasOption($option) || $app->getDefinition()->hasShortcut($option)) {
                $command_option = true;
                break;
            }
        }
        // Load default config
        if(!in_array('--config', $args) && !in_array('-c', $args) && !$command_option) {
            array_push($args, '--config', __DIR__ . DS . 'behat.yml');
        }

        $input = new Symfony\Component\Console\Input\ArgvInput($args);
        $app->run($input);
    }

    function _loadModels() {
        ClassRegistry::addObject('Models', App::objects('model'));
        foreach(App::objects('model') as $model) {
			ClassRegistry::init(array('class' => $model, 'ds' => 'test'));
        }
    }
    
	function _initDb() {
		$testDbAvailable = in_array('test', array_keys(ConnectionManager::enumConnectionObjects()));

		$_prefix = null;

		if ($testDbAvailable) {
			// Try for test DB
			restore_error_handler();
			@$db =& ConnectionManager::getDataSource('test');
			$testDbAvailable = $db->isConnected();
		}

		// Try for default DB
		if (!$testDbAvailable) {
			$db =& ConnectionManager::getDataSource('default');
			$_prefix = $db->config['prefix'];
			$db->config['prefix'] = 'test_suite_';
		}

		ConnectionManager::create('test_suite', $db->config);
		$db->config['prefix'] = $_prefix;
		ClassRegistry::config(array('ds' => 'test_suite'));
	}
    
}
