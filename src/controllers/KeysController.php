<?php

class KeysController {
  public function index()
  {
    global $db;
    $data = $db->keys('*');
    $result = [
      'status' => true,
      'code' => 200,
      'data' => $data,
    ];
    return json_encode($result);
  }

  // public function store()
  // {
  //   return ;
  // }
}
