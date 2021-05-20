<?php

require_once('../controllers/signin.php');

//会員情報表示
function member_choice(){
//マイページボタンを押下した場合
if(isset($_POST['mypage'])){

  //ユーザー名を変数に格納
  $username = $_SESSION['user_name'];


  //データバース内、ユーザー名でユーザー情報取得
  $result = select_user($username);

  

  $_SESSION['user_id'] = $result['user_id'];
  $_SESSION['user_name']= $result['user_name'];
  $_SESSION['email']= $result['email'];
  $_SESSION['created_at']= $result['created_at'];
  $_SESSION['updated_at']= $result['updated_at'];

  

  header('Location: ./user_info.php');
  exit;
}
}
?>