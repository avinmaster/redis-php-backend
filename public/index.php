<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

require '../src/router.php';
require '../src/redis.php';
require '../src/controllers/KeysController.php';

$keys_controller = new KeysController();

router('GET', '^/$', [$keys_controller, 'index']);
// Сделал GET потому что с другими методами выдаются CORS ошибки
router('GET', '^/(?<key>(?s).*+)$', [$keys_controller, 'delete']);

header("HTTP/1.0 404 Not Found");
echo '404 Not Found';
