<?php
include_once __DIR__ . '/../models/comments.php';
header('Content-Type: application/json');

if($_REQUEST['action'] === 'index'){
  echo json_encode(Comments::all());
} else if ($_REQUEST['action'] === 'post'){
  $request_body = file_get_contents('php://input');
  $body_object = json_decode($request_body);
  $new_comment = new Comment(null, $body_object->vendorid, $body_object->content, $body_object->username, null);
  $all_comments = Comments::create($new_comment);
  echo json_encode($all_comments);
} else if ($_REQUEST['action'] === 'update'){
  $request_body = file_get_contents('php://input');
  $body_object = json_decode($request_body);
  $updated_comment = new Comment($_REQUEST['id'], $body_object->vendorid, $body_object->content, $body_object->username, null);
  $all_comments = Comments::update($updated_comment);
  echo json_encode($all_comments);
} else if ($_REQUEST['action'] === 'delete'){
  $all_comments = Comments::delete($_REQUEST['id']);
  echo json_encode($all_comments);
}
?>
