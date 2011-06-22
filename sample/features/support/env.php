<?php
$world->getPathTo = function($path) use($world) {
    switch ($path) {
    case 'TopPage': return 'posts';
    case 'トップページ': return 'posts';
    default: return $path;
  }
};
?>