<?php
require '../main/db.php';
require '../vendor/autoload.php';

use Predis\Client;

$client = new Client([
    'host' => REDIS_IP,
    'port' => REDIS_PORT,
]);
?>
