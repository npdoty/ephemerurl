<?php
require_once 'php-activerecord/ActiveRecord.php';
date_default_timezone_set('America/Los_Angeles');

ActiveRecord\Config::initialize(function($cfg)
{
    $cfg->set_model_directory('.');
    $cfg->set_connections(array(
        'development' => 'sqlite://urls.db'));
});

class Urlmap extends ActiveRecord\Model { }

/**
 * Generates human-readable string.
 *
 * @param string $length Desired length of random string.
 * 
 * @return string Random string.
 * via: https://gist.github.com/sepehr/3371339
 */
function readable_random_string($length = 6)
{  
    $string     = '';
    $vowels     = array("a","e","i","o","u");  
    $consonants = array(
        'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 
        'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
    );  

    // Seed it
    srand((double) microtime() * 1000000);

    $max = $length/2;
    for ($i = 1; $i <= $max; $i++)
    {
        $string .= $consonants[rand(0,19)];
        $string .= $vowels[rand(0,4)];
    }

    return $string;
}

function scheme_host_port($server) {
  $scheme = $server['HTTPS'] ? 'https://' : 'http://';
  $host = $server['SERVER_NAME'];
  $port = '';
  if (($server['SERVER_PORT'] != '80') && ($server['SERVER_PORT'] != '443')) {
    $port = ':'.$server['SERVER_PORT'];
  }
  
  return $scheme.$host.$port;
}

$path_pieces = explode("/", $_SERVER["REQUEST_URI"]);

if ($path_pieces[2] == "until") { // for paths like /until/someotherpath, create a new url mapping
  $map = Urlmap::create(array('target' => $path_pieces[3], 'source' => readable_random_string()));
  $map->save();
  
  print scheme_host_port($_SERVER).'/u/'.$map->source;
}

if ($path_pieces[2] == "u") { // for paths like /u/abcdef, look up an already existing record and redirect
  $map = Urlmap::find_by_source($path_pieces[3]);
  if ($map) {
    header('Location: '.scheme_host_port($_SERVER).'/'.$map->target);
  } else {
    http_response_code(404);
    print 'No such short URL.';
  }
}
?>