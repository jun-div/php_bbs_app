<?php 
require_once('../models/dbc.php');

require_once('../controllers/signin.php');

require_once('../controllers/post.php');

//ログイン状態の場合
if(isset($_SESSION['user_name'])){
  //登録しているユーザー名表示
  $username = $_SESSION['user_name'];

}else{
  //それ以外、ログイン画面へ
  
  header('Location: ./login.php');
  exit;

}

//エラーメッセージ
$errors = post_data();

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="./css/style.css" rel="stylesheet">
      <title>投稿</title>
  </head>
  <body>
      <div class="container">
        <div class="wrapper">
           <form action="post_form.php" method="post" class="form-post">
              <h2 class="form-post-heading">投稿フォーム</h2>
                 <hr class="colorgraph"><br>
                 <?php if( !empty($errors)): ?>
                  <ul class="error_list">
                    <?php foreach( $errors as $msg ): ?>
                      <li><?php echo $msg; ?></li><br>
                    <?php endforeach; ?>
                  </ul>
                  <?php endif; ?>
                  <h5>ユーザー名：</h5>
                  <input type="text" class="form-control" name="username" disabled value="<?php echo $username;?>"><br>
                  <h5>投稿内容：</h5>
                  <textarea cols="30" rows="10" class="textarea-primary" name="post_content"  autofocus=""></textarea><br>
                  <br>
                  <button class="btn btn-lg btn-primary btn-block" name="write" type="submit">投稿する</button><br>
                  <h3><center><a href="bbs.php">投稿一覧へ戻る</a></center></h3>
            </form>
          </div>
        </div>
     </body>
</html>