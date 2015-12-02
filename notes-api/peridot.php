<?php
require_once 'vendor/autoload.php';


use Evenement\EventEmitterInterface;
use Peridot\Plugin\Prophecy\ProphecyPlugin;

return function (EventEmitterInterface $emitter) {
	new ProphecyPlugin($emitter);
};