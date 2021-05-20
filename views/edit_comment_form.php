<?php
require_once('../models/dbc.php');

require_once('../controllers/signin.php');

require_once('../controllers/edit_comment.php');

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
if(isset($_GET['comment_id'])){
  
  //親記事ID
  $comment_id = $_GET['comment_id'];

}else{
  
  $comment_id = $_POST['comment_id'];
}

//コメント内容取得
$result = select_comment_content($comment_id);

//コメント内容を変数に格納
$comment_content = $result['comment_content'];


//エラーメッセージ
$errors = edit_comment();


?>
<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="./css/style.css" rel="stylesheet">
      <title>コメント内容更新</title>
  </head>
  <body>
      <div class="container">
        <div class="wrapper">
           <form action="edit_comment_form.php" method="post" class="form-edit-comment">
              <h2 class="form-edit-comment-heading">コメント編集フォーム</h2>
                 <hr class="colorgraph"><br>
                 <?php if( !empty($errors)): ?>
                  <ul class="error_list">
                    <?php foreach( $errors as $msg ): ?>
                      <li><?php echo $msg; ?></li><br>
                    <?php endforeach; ?>
                  </ul>
                  <?php endif; ?>
                  <h5>元コメント内容：</h5>
                  <b><?php echo $comment_content; ?></b><br>
                  <h5>更新内容：</h5>
                  <textarea cols="30" rows="10" class="textarea-primary" name="edit_comment_content"  autofocus=""></textarea><br>
                  <br>
                  <button class="btn btn-lg btn-primary btn-block" name="edit_comment" type="submit">内容更新</button><br>
                  <h3><center><a href="bbs.php">投稿一覧へ戻る</a></center></h3>
                  <input type="hidden" name="comment_id" value="<?php echo $comment_id;?>">
                  <input type="hidden" name="comment_content" value="<?php echo $comment_content;?>">
            </form>
          </div>
        </div>
     </body>
</html>