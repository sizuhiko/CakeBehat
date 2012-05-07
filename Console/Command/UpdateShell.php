<?php
class UpdateShell extends Shell {
    public $tasks = array('CakeBehat.Download');
    
    public function main() {
        $this->Download->behat();
        $this->Download->mink();
    }
}
