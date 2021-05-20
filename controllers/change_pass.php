<?php

//パスワード変更
function change_pass(){

  //パスワード変更ボタン押下時
  if(isset($_POST['change_pass'])){

    $password = $_POST['password'];
    $email = $_POST['email'];
    $errors = array();

    //パスワード空チェック
  if(empty($password)){
  
    $errors[] ="※パスワードを入力してください。";
     
  }
  
  //パスワード文字チェック（正規表現）
  if (!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $password)) {
  
    $errors[] ="※パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で入力してください。";
    
  }

  //パスワード文字数チェック
  if(mb_strlen($password) >= 60){
    
    $errors[] ="※パスワードが長すぎます。60文字以内で入力してください。";

    }

  //入力値チェックの結果、エラーメッセージありの場合
  if(!empty($errors)){

      //エラーメッセージを返して登録画面へ
      return $errors;
      header('Location: ./change_pass_form.php');
      exit;

    }else{
    
    //パスワードハッシュ化
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    //パスワード変更処理
    update_pass($password,$email);
    
    //セッションを空に
    $_SESSION = array();

    //クッキー削除
     if(isset($_COOKIE["PHPSESSID"])){
    
      setcookie("PHPSESSID",'',time()-1800,'/');
  }

    //セッション破棄
     session_destroy();
     
     //更新完了画面へ
     header('Location: ./change_pass_completed.php');
     exit;
    }
  }
}


?>