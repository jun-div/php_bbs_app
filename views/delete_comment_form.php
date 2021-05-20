<?php
require_once('../models/dbc.php');

require_once('../controllers/signin.php');

require_once('../controllers/delete_comment.php');

//ログイン状態の場合
if(isset($_SESSION['user_name'])){
  //登録しているユーザー名表示
  $username = $_SESSION['user_name'];

}else{
  //それ以外、ログイン画面へ
  header('Location: ./login.php');
  exit;

}

//削除押下時に送られたコメントIDなら
if(isset($_GET['comment_id'])){
  
  
  $comment_id = $_GET['comment_id'];

}else{
  
  $comment_id = $_POST['comment_id'];
}

//削除したいコメント内容取得
$result = select_comment_content($comment_id);

//削除したいコメント内容を変数に格納
$comment_content = $result['comment_content'];

//コメント削除
delete_comment();


?>

<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="./css/style.css" rel="stylesheet">
      <title>コメント削除</title>
  </head>
  <body>
      <div class="container">
        <div class="wrapper">
           <form action="delete_comment_form.php" method="post" class="form-delete-comment">
              <h2 class="form-delete-comment-heading">本当に削除しますか？</h2>
                 <hr class="colorgraph"><br>
                  <b><?php echo $comment_content; ?></b><br>
                  <br>
                  <button class="btn btn-lg btn-primary btn-block" name="delete_comment" type="submit">コメント削除</button><br>
                  <h3><center><a href="bbs.php">投稿一覧へ戻る</a></center></h3>
                  <input type="hidden" name="comment_id" value="<?php echo $comment_id;?>">
            </form>
        </div>
      </div>
  </body>
</html>