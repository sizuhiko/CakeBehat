<?php

$steps->Given('/^ブログ記事に以下の内容が登録されていること:$/', function($world, $table) {
  $hash = $table->getHash();
  $world->truncateModel('Post');
  $post = $world->getModel('Post');
  foreach ($hash as $row) {
	$post->create(array('Post'=>array('title'=>$row['タイトル'], 'body'=>$row['本文'])));
	$post->save();
  }
});

?>