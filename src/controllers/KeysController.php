<?php

class KeysController {
  public function index()
  {
    global $db;
    $keys = $db->keys('*');
    $data = [];

    foreach ($keys as $key) {
      $value = $db->get($key);
      $data[$key] = $value;
    }

    $result = [
      'status' => true,
      'code' => 200,
      'data' => $data,
    ];
    return json_encode($result);
  }

  public function delete($key)
  {
    global $db;

    try {
      $db->delete($key);
      $result = [
        'status' => true,
        'code' => 200
      ];
    } catch (Exception $e) {
      $result = [
        'status' => false,
        'code' => 500,
        'data' => ("Can't delete key: " . $e->getMessage())
      ];
    }

    return json_encode($result);
  }
}
