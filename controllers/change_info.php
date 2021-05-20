<?php

//会員情報変更
function change_info(){

  //変更するボタン押下時
  if(isset($_POST['change'])){

    $user_id = $_SESSION['user_id'];
    $username = htmlspecialchars($_POST['username'],ENT_QUOTES);
    $email = htmlspecialchars($_POST['email'],ENT_QUOTES);
    //エラーメッセージ
    $errors = array();

    //ユーザー名とメールアドレス空チェック
  if(empty($username) && empty($email)){

    $errors[] ="※変更したい項目を入力してください。";
    return $errors;
    header('Location: ./setting.php');
     
  }

  //ユーザー名が入力されている場合
  if(!empty($username)){
  
      //ユーザー名文字数チェック
      if(mb_strlen($username) >= 50){

      $errors[] ="※ユーザー名は50文字以内で入力してください。";

      }else{

        //ユーザー名重複チェック
        $check_name = check_name($username);

         //ユーザー名が重複してる場合
        if(isset($check_name['user_name'])){
      
        $errors[] ="※入力したユーザー名は既に登録されています。";

      }
    }
  
   //ユーザー名が入力されていない場合、セッションの値を変数に格納
  }else{
    $username = $_SESSION['user_name'];
  }

  
  //メールアドレスが入力されいる場合
  if(!empty($email)){
  
      //メールアドレス形式チェック
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          
      $errors[] ="※メールアドレスを変更する場合は正しい形式で入力してください。";
       
      }else{

        //メールアドレス重複チェック
      $check_email = check_email($email);

      //メールアドレスが重複してる場合
      if(isset($check_email['email'])){
      
        $errors[] ="※入力したメールアドレスは既に登録されています。";  
        
      }
    }
    //メールアドレスが入力されていない場合、セッションの値を変数に格納
  }else{
    $email = $_SESSION['email'];
  }

  if(!empty($errors)){
    return $errors;
    header('Location: ./setting.php');
      
  }else{

        //情報更新処理(ユーザー名、メールアドレス)
        update_user($username,$email,$user_id);

         //セッションを空に
        $_SESSION = array();

       //クッキー削除
        if(isset($_COOKIE["PHPSESSID"])){
       
         setcookie("PHPSESSID",'',time()-1800,'/');
     }
 
       //セッション破棄
        session_destroy();
        
        //更新完了画面へ
        header('Location: ./change_completed.php');
        exit;
      }
    } 
  }


  
?>