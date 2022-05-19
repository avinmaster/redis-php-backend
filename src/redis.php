<?php

$db = new Redis();
try {
  $db->connect('localhost', 6379);
} catch (Exception $e) {
  echo json_encode([
    'status' => false,
    'code' => '500',
    'data' => ("Can't connect to redis: " . $e->getMessage())
  ]);
  die;
}
