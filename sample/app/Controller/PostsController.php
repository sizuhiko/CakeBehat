<?php
class PostsController extends AppController {
    var $helpers = array ('Html','Form');
    var $name = 'Posts';

    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function view($id = null) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());
    }
}