<?php
class PostsController extends AppController {
  var $helpers = array ('Html','Form');
  var $name = 'Posts';
  function index() {
    $this->set('posts', $this->Post->find('all'));
  }
  function view($id = null) {
    $this->Post->id = $id;
    $this->set('post', $this->Post->read());
  }
}