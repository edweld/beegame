<?php

/**
 * App entrypoint for beegame 
 */

require("./vendor/autoload.php");

$settings = require("./config/settings.php");
$factory = new BeeGame\Factory($settings);
$handle = fopen ("php://stdin","r");
$game = $factory->getGame();
$game->start();
echo $settings['copy']['start'];
while($game->active()){
	$res = $game->action(fgets($handle));
	echo $res;
}
fclose($handle);

