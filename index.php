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
    $db->orderBy ('id', 'asc');
    $user = $db->get('user');
    echo json_encode($user);
  break;
  // 验证用户名是否重复（$db过滤后返回过滤后的数组集合，再查询得到数据表）
  case 'checkUsername':
    $username = $_GET['username'];
    $db->where('username', $username);
    setcookie("username", $username, time()+3600*24);
    $user = $db->get('user');
    echo json_encode($user);
  break;
  case 'checkPassword':
    $username = $_GET['username'];
    $password = $_GET['password'];
    $db->where('username', $username);
    $user = $db->get('user');
    echo json_encode($user);
  break;
  // 登录，验证用户名是否存在，验证密码是否正确
  case 'login':
    $username = $_GET['username'];
    $password = $_GET['password'];
    $db->where('username', $username);
    $user = $db->get('user');
    echo json_encode($user['password']);
  break;
  // 注册，数据库中添加一条数据
  case 'regis':
    $username = $_GET['username'];
    $password = $_GET['password'];
    $data = Array (
      'username'=> $username,
      'password'=> $password
    );
    // 用户名和密码不能为空
    if($username == ''||$password == ''){
      return false;
    }else{
      $id = $db->insert ('user', $data);
      if($id){
        echo '用户注册成功'.$id;
      }else{
        echo '用户注册失败'.$db->getLastError();
      }
    }
  break;
  // 更新一条数据
  case 'update':
    $username = $_GET['username'];
    $password = $_GET['password'];
    $id = $_GET['id'];
    $data = Array (
      'username'=> $username,
      'password'=> $password
    );
    $db->where('id', $id);
    $db->update ('user', $data);
    $user = $db->get('user');
    echo json_encode($user);
  break;
  // 删除一条数据
  case 'del':
    $id = $_GET['id'];
    $db->where('id', $id);
    $db->delete ('user');
    $user = $db->get('user');
    echo json_encode($user);
  break;
  // 退出登录，清除cookie
  case 'logout':
    setcookie("username", '');
    echo json_encode($_COOKIE);
  break;
}
?>