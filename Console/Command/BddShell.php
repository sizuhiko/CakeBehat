<?php

// define('BEHAT_ROOT', VENDORS . 'Behat' . DS);
define('BEHAT_PHP_BIN_PATH',    '/usr/bin/env php');
// define('BEHAT_BIN_PATH',        BEHAT_ROOT . 'bin/behat.php');
define('BEHAT_VERSION',         'DEV');
define('CAKEBEHAT_ROOT',         dirname(__FILE__));
Phar::loadPhar (dirname(__FILE__).'/behat-2.4.0beta1.phar');
Phar::loadPhar (dirname(__FILE__).'/mink.phar');
require_once 'phar://'.dirname(__FILE__).'/behat-2.4.0beta1.phar/vendor/.composer/autoload.php';
require_once 'phar://'.dirname(__FILE__).'/mink.phar/vendor/.composer/autoload.php';
#require_once 'phar://'.dirname(__FILE__).'/behat-2.1.3.phar/autoload.php';
#require_once 'mink-1.2.0.phar';

App::uses('Model', 'Model');
App::uses('ClassRegistry', 'Utility');
App::uses('ConnectionManager', 'Model');

class BddShell extends Shell {
    
    public function main() {
        $this->_initDb();

        $args = $_SERVER['argv'];
        do {
            array_shift($args);
        } while($args[0] != 'CakeBehat.bdd');

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
            array_push($args, '--config', APP . DS . 'Config' . DS . 'behat.yml');
        }
        $input = new Symfony\Component\Console\Input\ArgvInput($args);

        $app->run($input);
    }

	protected function _initDb() {
		$testDbAvailable = in_array('test', array_keys(ConnectionManager::enumConnectionObjects()));

		$_prefix = null;

		if ($testDbAvailable) {
			// Try for test DB
			restore_error_handler();
			$db = ConnectionManager::getDataSource('test');
			$testDbAvailable = $db->isConnected();
		}

		// Try for default DB
		if (!$testDbAvailable) {
			$db = ConnectionManager::getDataSource('default');
			$_prefix = $db->config['prefix'];
			$db->config['prefix'] = 'test_suite_';
		}

		ConnectionManager::create('test_suite', $db->config);
		$db->config['prefix'] = $_prefix;
		ClassRegistry::config(array('ds' => 'test_suite'));
	}
    

    public function getOptionParser() {
        $parser = new BehatConsoleOptionParser($this->name);
        return $parser;
    }

}
class BehatConsoleOptionParser extends ConsoleOptionParser {
    public function parse($argv, $command = null) {
        $params = $args = array();
        return array($params, $args);
    }
}
/*
class CakeBehatContext extends Behat\BehatBundle\Context\MinkContext
{
    function getModel($name) {
        $model = ClassRegistry::init(array('class' => $name, 'ds' => 'test'));
        return $model;
    }
    function truncateModel($name) {
        $model = ClassRegistry::init(array('class' => $name, 'ds' => 'test'));
        $table = $model->table;
        $db = ConnectionManager::getDataSource('test_suite');
        $db->truncate($table);
    }
}
*/