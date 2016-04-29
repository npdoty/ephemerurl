<?php
require_once 'php-activerecord/ActiveRecord.php';

ActiveRecord\Config::initialize(function($cfg)
{
    $cfg->set_model_directory('.');
    $cfg->set_connections(array(
        'development' => 'sqlite://urls.db'));
});

class Urlmap extends ActiveRecord\Model
{
}

$path_pieces = explode("/", $_SERVER["REQUEST_URI"]);
print_r($path_pieces);

if ($path_pieces[2] == "until") {
  $map = UrlMap::create(array('target' => $path_pieces[3], 'source' => 'abcd'));
  $map->save();
}

?>