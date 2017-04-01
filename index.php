<?php 
header("Access-Control-Allow-Origin: *");
require_once ('./libs/MysqliDb.php');
$jsonp = $_GET['username'];
$db = new MysqliDb (Array (
  'host' => 'localhost',
  'username' => 'root', 
  'password' => 'root',
  'db'=> 'user',
  'port' => 3306,
  'prefix' => '',
  'charset' => 'utf8'));
$users = $db->get('users');
echo json_encode($users)
?>