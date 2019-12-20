<?php
include_once __DIR__ . '/../models/comments.php';
header('Content-Type: application/json')

if($_REQUEST['action'] === 'index'){
  echo json_encode(Comments::all());
} else if ($_REQUEST['action'] === 'post'){
  $request_body = file_get_contents('php://input');
  $body_object = json_encode($request_body);
  $new_comment = new Comment($body_object->username, $body_object->vendorid, $body_object->content);
  $all_comments = Comments::create($new_comment);
  echo json_encode($all_comments);
} else if ($_REQUEST['action'] === 'update'){
  $request_body = file_get_contents('php://input');
  $body_object = json_encode($request_body);
  $updated_comment = new Comment($body_object->username, $body_object->vendorid, $body_object->content, $body_object->id);
  $all_comments = Comments::update($updated_comment);
} else if ($_REQUEST['action'] === 'delete'){
  $all_comments = Comments::delete($_REQUEST['id']);
  echo json_encode($all_comments)
}
?>
