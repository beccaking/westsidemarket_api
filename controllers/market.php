<?php
include_once __DIR__ . '/../models/market.php';
header('Content-Type: application/json');

if($_REQUEST['action'] === 'index'){
  echo json_encode(Market::all());
}
?>
