<?php 
header("Access-Control-Allow-Origin: *");
require_once ('./libs/MysqliDb.php');
$type = $_GET['type'];
$db = new MysqliDb (Array (
  'host' => 'localhost',
  'username' => 'root', 
  'password' => 'root',
  'db'=> 'user',
  'port' => 3306,
  'prefix' => '',
  'charset' => 'utf8'));
switch ($type) {
  // 输出数据表数组
  case 'getUser':
    $user = $db->get('user');
    echo json_encode($user);
  break;
  // 验证用户名是否重复（$db过滤后返回过滤后的数组集合，再查询得到数据表）
  case 'checkUsername':
    $username = $_GET['username'];
    $db->where('username', $username);
    $user = $db->get('user');
    echo json_encode($user);
  break;
  // 注册，数据库中添加一条数据
  case 'regis':
    $username = $_GET['username'];
    $password = $_GET['password'];
    $data = Array (
      'username'=> $username,
      'password'=> $password
    );
    $id = $db->insert ('user', $data);
    if($id){
      echo '用户注册成功'.$id;
    }else{
      echo '用户注册失败'.$db->getLastError();
    }
  break;
}
?>