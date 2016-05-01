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
function readable_random_string($length = 4)
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

if ($path_pieces[2] == "u") { // for paths like /u/abcdef, look up an already existing record and redirect
  $map = Urlmap::find_by_source($path_pieces[3]);
  if ($map) {
    // TODO: check for expiry
    header('Location: '.scheme_host_port($_SERVER).'/'.$map->target);
  } else {
    http_response_code(404);
    print 'No such short URL.';
  }
}
?>
<!DOCTYPE html>
<head>
  <title>npdoty.name ephemerurl</title>
  <style type="text/css" media="screen">
  body {
    font-size: 18px;
  }
  body.success {
    background-color: lightgreen;
  }
  .url {
    font-family: monospace;
  }
  .aside {
    padding: 10px 0px 10px 40px;
  }
  
  div.success {
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    margin-top: 100px;
    padding: 10px 30px 10px 30px;
    border: 3px solid darkgreen;
    background-color: white;
  }
  </style>
</head>
<?php
// for paths like /until6pm/someotherpath, create a new url mapping
// TODO: also handle patterns like /for20minutes/ and maybe /forever/
if (preg_match('/\/until([a-z0-9]+)\/(.+)/', $_SERVER["REQUEST_URI"], $matches)) { 
  $expiry = new DateTime($matches[1]);
  // TODO: check the random string against the database to avoid collisions
  $map = Urlmap::create(array(
    'target' => $matches[2], 
    'source' => readable_random_string(), 
    'expiry' => $expiry->format('c')
  ));
  $map->save();
  ?>
<body class="success">
  <div class="success">
    <p>Okay, Nick, here's an ephemeral URL you can use:</p>
    <p class="aside"><strong class="url"><?=scheme_host_port($_SERVER).'/u/'.$map->source ?></strong></p>
    <p>Until <strong class="datetime"><?=$expiry->format('c')?></strong> (when it becomes <span class="url">410 Gone</span>), that will redirect to <strong class="url"><?=scheme_host_port($_SERVER).'/u/'.$map->target ?></strong>.</p>
  </div>
</body>
  <?php
}
?>