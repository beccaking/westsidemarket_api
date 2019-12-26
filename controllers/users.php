<?php
include_once __DIR__ . '/../models/users.php';
header('Content-Type: application/json');

if($_REQUEST['action'] === 'post'){
  $request_body = file_get_contents('php://input');
  $body_object = json_decode($request_body);
  $new_user = new User(null, $body_object->username, $body_object->password);
  echo json_encode($new_user->username);
}
?>
