<?php 
App::uses('Shell', 'Console');

class DownloadTask extends Shell {
    public function behat() {
        $this->out("downloading behat.phar...");
        $this->download("https://github.com/downloads/Behat/Behat/behat-2.4.0beta1.phar");
    }

    public function mink() {
        $this->out("downloading mink.phar...");
        $this->download("https://github.com/downloads/Behat/Mink/mink.phar");
    }

    private function download($uri) {
        $fp = fopen($uri, "r" );
        if ( $fp !== FALSE ) {
            file_put_contents(dirname(dirname(__FILE__)) . DS . basename($uri), "");
            while( !feof( $fp ) ) {
                $buffer = fread( $fp, 4096 );
                if ( $buffer !== FALSE ) {
                    file_put_contents(dirname(dirname(__FILE__)) . DS . basename($uri), $buffer, FILE_APPEND );
                }
            }
            fclose( $fp );
        }
    }
}