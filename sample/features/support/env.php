<?php
$world->getPathTo = function($path) use($world) {
    switch ($path) {
    case 'トップページ': return 'posts';
    default: return $path;
  }
};
?>