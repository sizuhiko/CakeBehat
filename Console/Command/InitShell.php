<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class InitShell extends Shell {
    
    public function main() {
        $this->out("downloading behat.phar...");
        $this->download("https://github.com/downloads/Behat/Behat/behat-2.1.3.phar");
        $this->out("downloading mink.phar...");
        $this->download("https://github.com/downloads/Behat/Mink/mink.phar");

        $Folder = new Folder(dirname(dirname(dirname(__FILE__))) . DS . "features");
        $this->out("copy ".$Folder->pwd()." to Cake Root...");
        $Folder->copy(array('to' => ROOT . DS . "features"));

        $File = new File(dirname(__FILE__) . DS . "behat.yml.default");
        $this->out("copy ".$File->name()." to App/Config...");
        $File->copy(APP . DS . "Config".  DS. "behat.yml");

    }

    private function download($uri) {
        $fp = fopen($uri, "r" );
        if ( $fp !== FALSE ) {
            file_put_contents(dirname(__FILE__) . DS . basename($uri), "");
            while( !feof( $fp ) ) {
                $buffer = fread( $fp, 4096 );
                if ( $buffer !== FALSE ) {
                    file_put_contents(dirname(__FILE__) . DS . basename($uri), $buffer, FILE_APPEND );
                }
            }
            fclose( $fp );
        }
    }
}
