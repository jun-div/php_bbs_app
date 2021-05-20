<?php
//データベース
require_once '../models/dbc.php';

//ログイン
require_once '../controllers/signin.php';

//ログアウト
require_once '../controllers/logout.php';

//ログイン状態の場合
if (isset($_SESSION['user_name'])) {
    //登録しているユーザー名表示
    $username = $_SESSION['user_name'];

} else {
    //それ以外、ゲスト表示
    $username = "ゲスト";

}

//親記事一覧取得
$post_result = select_post_list();

//コメント一覧取得
$comment_result = select_comment_list();

//ログアウト
logout();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./css/style.css" rel="stylesheet">
  <title>掲示板</title>
</head>

<body>
  <?php require_once 'header.php';?><br>
  <?php if (empty($_SESSION['user_name'])): ?>
  <center>ログインまたは会員登録して投稿しよう！</center><br>
  <?php else: ?>
  <center>気軽に投稿してみよう！</center><br>
  <?php endif;?>
  <div class="post_form">
    <input type="button" class="post_button" onclick="location.href='./post_form.php'" value="投稿する">
  </div>
  <br>
  <div id="post_area">
    <div class=post_list>
      <?php if (empty($post_result)): ?>
      <?php echo "<center>" . 'まだ投稿はありません。' . "</center>"; ?>
      <?php endif;?>
      <!-- 親記事 -->
      <?php foreach ($post_result as $post_list): ?>
      #<?php echo $post_list['post_id']; ?>
      <?php if ($post_list['delete_flag'] == 1): ?>
      <?php echo "この投稿は削除されました。"; ?><br>
      <?php else: ?>
      <span><?php echo $post_list['user_name']; ?></span>さん
      <?php echo "\t"; ?>
      <?php echo $post_list['created_at']; ?>
      <?php endif;?>
      <!-- ログインしているユーザー名と投稿者が同じかつ削除フラグ０の場合 -->
      <?php if ($post_list['user_name'] == $username && $post_list['delete_flag'] == 0): ?>
      <a href="reply_form.php?post_id=<?php echo $post_list['post_id']; ?>">返信</a>
      <a href="edit_post_form.php?post_id=<?php echo $post_list['post_id']; ?>">編集</a>
      <a href="delete_post_form.php?post_id=<?php echo $post_list['post_id']; ?>">削除</a><br>
      <?php echo $post_list['post_content']; ?><br>
      <?php endif;?>
      <!-- ポストテーブルの削除フラグ０かつログインしているユーザー名と投稿者が違う場合 -->
      <?php if ($post_list['delete_flag'] == 0 && $post_list['user_name'] != $username): ?>
      <a href="comment_form.php?post_id=<?php echo $post_list['post_id']; ?>">コメント</a><br>
      <?php echo $post_list['post_content']; ?><br>
      <?php endif;?>


      <!--コメント -->
      <?php foreach ($comment_result as $comment_list): ?>
      <!-- コメントテーブルの削除フラグ１の場合非表示-->
      <?php if ($comment_list['delete_flag'] == 1): ?>
      <?php endif;?>
      <!-- 両テーブルの削除フラグ０の時のみ内容表示-->
      <?php if ($comment_list['delete_flag'] == 0 && $post_list['delete_flag'] == 0): ?>
      <?php if ($post_list['post_id'] == $comment_list['parent_id']): ?>
      >><span><?php echo $comment_list['user_name']; ?></span>さん
      <?php echo "\t"; ?>
      <?php echo $comment_list['created_at']; ?>
      <?php if ($comment_list['user_name'] == $username): ?>
      <a href="edit_comment_form.php?comment_id=<?php echo $comment_list['comment_id']; ?>">編集</a>
      <a href="delete_comment_form.php?comment_id=<?php echo $comment_list['comment_id']; ?>">削除</a>
      <?php endif;?>
      <br>
      <?php echo $comment_list['comment_content']; ?><br>
      <?php endif;?>
      <?php endif;?>
      <?php endforeach;?>
      <hr>
      <?php endforeach;?>
    </div>
  </div>
  <br>
  <div class="post_form">
    <input type="button" class="post_button" onclick="location.href='./post_form.php'" value="投稿する">
  </div>
  <br>
</body>
</html>