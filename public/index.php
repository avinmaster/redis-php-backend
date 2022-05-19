<?php

header('Content-Type: application/json');

require '../src/router.php';
require '../src/redis.php';
require '../src/controllers/KeysController.php';

$keys_controller = new KeysController();

router('GET', '^/$', [$keys_controller, 'index']);
router('GET', '^/(?<key>\d+)$', [$keys_controller, 'delete']);

header("HTTP/1.0 404 Not Found");
echo '404 Not Found';
