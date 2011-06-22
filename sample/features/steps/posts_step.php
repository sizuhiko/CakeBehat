<?php

$steps->Given('/^there is a post:$/', function($world, $table) {
  $hash = $table->getHash();
  $world->truncateModel('Post');
  $post = $world->getModel('Post');
  foreach ($hash as $row) {
	$post->create(array('Post'=>array('title'=>$row['Title'], 'body'=>$row['Body'])));
	$post->save();
  }
});

?>