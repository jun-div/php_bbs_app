<?php
require_once('../models/dbc.php');

require_once('../controllers/signin.php');

require_once('../controllers/comment.php');


//ログイン状態の場合
if(isset($_SESSION['user_name'])){
  //登録しているユーザー名表示
  $username = $_SESSION['user_name'];

}else{
  //それ以外、ログイン画面へ
  header('Location: ./login.php');
  exit;

}

//コメント押下時に送られた親記事IDなら
if(isset($_GET['post_id'])){
  
  //親記事ID
  $parent_id = $_GET['post_id'];

}else{
  
  $parent_id = $_POST['post_id'];
}

//親記事内容取得
$result = parent_data($parent_id);

//親記事内容を変数に格納
$parent_content = $result['post_content'];


//エラーメッセージ
$errors = comment_data();


?>
<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="./css/style.css" rel="stylesheet">
      <title>返信</title>
  </head>
  <body>
      <div class="container">
        <div class="wrapper">
           <form action="reply_form.php" method="post" class="form-comment">
              <h2 class="form-comment-heading">返信フォーム</h2>
                 <hr class="colorgraph"><br>
                 <?php if( !empty($errors)): ?>
                  <ul class="error_list">
                    <?php foreach( $errors as $msg ): ?>
                      <li><?php echo $msg; ?></li><br>
                    <?php endforeach; ?>
                  </ul>
                  <?php endif; ?>
                  
                  <br>
                  <h5>ユーザー名：</h5>
                  <input type="text" class="form-control" name="username" disabled value="<?php echo $username;?>"><br>
                  <h5>返信内容：</h5>
                  <textarea cols="30" rows="10" class="textarea-primary" name="comment_content"  autofocus=""></textarea><br>
                  <br>
                  <button class="btn btn-lg btn-primary btn-block" name="comment" type="submit">返信</button><br>
                  <h3><center><a href="bbs.php">投稿一覧へ戻る</a></center></h3>
                  <input type="hidden" name="post_id" value="<?php echo $parent_id;?>">
                  <input type="hidden" name="parent_content" value="<?php echo $parent_content;?>">
            </form>
          </div>
        </div>
     </body>
</html>