<?php
require_once '../models/dbc.php';

require_once '../controllers/member.php';

require_once '../controllers/change_info.php';

//会員情報取得処理関数
member_choice();

$username = $_SESSION['user_name'];
$email = $_SESSION['email'];

//エラーメッセージ
$errors = change_info();

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="./css/style.css" rel="stylesheet">
      <title>会員情報変更</title></title>
  </head>
  <body>
      <div class="container">
        <div class="wrapper">
           <form action="setting.php" method="post" class="form_setting">
              <h2 class="form-setting-heading">会員情報変更</h2>
                 <hr class="colorgraph"><br>
                 <?php if (!empty($errors)): ?>
                  <ul class="error_list">
                    <?php foreach ($errors as $msg): ?>
                      <li><?php echo $msg; ?></li><br>
                    <?php endforeach;?>
                  </ul>
                  <?php endif;?>
                  <h5>ユーザー名：</h5>
                    <input type="text" class="form-control" name="username"  placeholder="<?php echo $username; ?>">
                    <h5>メールアドレス：</h5>
                    <input type="text" class="form-control" name="email"  placeholder="<?php echo $email; ?>">
                    <b>※変更する必要のない項目は入力不要！</b><br>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" name="change" type="submit">変更する</button><br>
                    <a href="change_pass_form.php">
                    <h3 class="change_pass">パスワード変更はこちら</h3></a><br>
                    <h3><center><a href="bbs.php">投稿一覧へ戻る</a></center></h3>
              </form>
          </div>
        </div>
     </body>
</html>