<?php



//会員登録
function check_entry(){

//会員登録ボタンを押下した場合
if(isset($_POST['signup'])){

  //送られてきたデータを各々の変数に格納
$username = htmlspecialchars($_POST['username'],ENT_QUOTES);
$email = $_POST['email'];
$password = $_POST['password'];
//エラーメッセージを格納する変数
$errors = array();

  //ユーザー名空チェック
  if(empty($username)){

    $errors[] ="※ユーザー名を入力してください。";
     
  }

  //ユーザー名文字数チェック
  if(mb_strlen($username) >= 50){

    $errors[] ="※ユーザー名は50文字以内で入力してください。";

  }
  
  //メールアドレス空チェック
  if(empty($email)){
  
    $errors[] ="※メールアドレスを入力してください。";
  
  }
  
  //メールアドレス形式チェック
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          
    $errors[] ="※メールアドレスを正しい形式で入力してください。";
       
  }

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
      header('Location: ./register.php');
      exit;

    }

    //ユーザー名重複チェック結果
    $check_name = check_name($username);

    //ユーザー名が重複してる場合
  if(isset($check_name['user_name'])){
      
      $errors[] ="※入力したユーザー名は既に登録されています。";

    }

    //メールアドレス重複チェック結果
    $check_email = check_email($email);

    //メールアドレスが重複してる場合
  if(isset($check_email['email'])){
      
        $errors[] ="※入力したメールアドレスは既に登録されています。";  
        
       }
       
  //データベース内重複チェック結果、重複ありの場合
  if(!empty($errors)){

    //エラーメッセージを返して登録画面へ
    return $errors;
    header('Location: ./register.php');
    exit;
  
  //重複なしの場合
   }else{
     //パスワードハッシュ化
    $password = password_hash($password, PASSWORD_DEFAULT);
    //データベース登録処理
    entry($username,$email,$password);
    //登録完了画面へ
    header('Location: ./successful.php');
    exit;
    }
  }
}
  
 
 ?>