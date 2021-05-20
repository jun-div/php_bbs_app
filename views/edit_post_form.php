<?php
require_once('../models/dbc.php');

require_once('../controllers/signin.php');

require_once('../controllers/edit_post.php');

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
  $post_id = $_GET['post_id'];

}else{
  
  $post_id = $_POST['post_id'];
}

//編集する投稿内容取得
$result = select_post_content($post_id);

//編集する投稿内容を変数に格納
$post_content = $result['post_content'];


//エラーメッセージ
$errors = edit_post();


?>
<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="./css/style.css" rel="stylesheet">
      <title>投稿内容更新</title>
  </head>
  <body>
      <div class="container">
        <div class="wrapper">
           <form action="edit_post_form.php" method="post" class="form-edit-post">
              <h2 class="form-edit-post-heading">投稿編集フォーム</h2>
                 <hr class="colorgraph"><br>
                 <?php if( !empty($errors)): ?>
                  <ul class="error_list">
                    <?php foreach( $errors as $msg ): ?>
                      <li><?php echo $msg; ?></li><br>
                    <?php endforeach; ?>
                  </ul>
                  <?php endif; ?>
                  <h5>元記事内容：</h5>
                  <b><?php echo $post_content; ?></b><br>
                  <h5>更新内容：</h5>
                  <textarea cols="30" rows="10" class="textarea-primary" name="edit_post_content"  autofocus=""></textarea><br>
                  <br>
                  <button class="btn btn-lg btn-primary btn-block" name="edit_post" type="submit">内容更新</button><br>
                  <h3><center><a href="bbs.php">投稿一覧へ戻る</a></center></h3>
                  <input type="hidden" name="post_id" value="<?php echo $post_id;?>">
                  <input type="hidden" name="post_content" value="<?php echo $post_content;?>">
            </form>
          </div>
        </div>
     </body>
</html>