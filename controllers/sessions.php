<?php
include_once __DIR__ . '/../models/users.php';
header('Content-Type: application/json');

if ($_REQUEST['action'] === 'post'){
  session_start();
  $request_body = file_get_contents('php://input');
  $body_object = json_decode($request_body);
  $_SESSION["username"] = $body_object->username;
  echo $_SESSION["username"];
} else if ($_REQUEST['action'] === 'delete'){
  session_unset();
  session_destroy();
}

 ?>
