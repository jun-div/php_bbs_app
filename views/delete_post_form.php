<?php
require_once('../models/dbc.php');

require_once('../controllers/signin.php');

require_once('../controllers/delete_post.php');

//ログイン状態の場合
if(isset($_SESSION['user_name'])){
  //登録しているユーザー名表示
  $username = $_SESSION['user_name'];

}else{
  //それ以外、ログイン画面へ
  header('Location: ./login.php');
  exit;

}

//削除押下時に送られた投稿IDなら
if(isset($_GET['post_id'])){

$post_id = $_GET['post_id'];

}else{

$post_id = $_POST['post_id'];

}

//削除したい投稿内容取得
$result = select_post_content($post_id);

//削除したい投稿内容を変数に格納
$post_content = $result['post_content'];

//投稿削除
delete_post();

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="./css/style.css" rel="stylesheet">
      <title>投稿削除</title>
  </head>
  <body>
      <div class="container">
        <div class="wrapper">
           <form action="delete_post_form.php" method="post" class="form-delete-post">
              <h2 class="form-delete-post-heading">本当に削除しますか？</h2>
                 <hr class="colorgraph"><br>
                  <b><?php echo $post_content; ?></b><br>
                  <br>
                  <button class="btn btn-lg btn-primary btn-block" name="delete_post" type="submit">投稿削除</button><br>
                  <h3><center><a href="bbs.php">投稿一覧へ戻る</a></center></h3>
                  <input type="hidden" name="post_id" value="<?php echo $post_id;?>">
            </form>
          </div>
        </div>
     </body>
</html>