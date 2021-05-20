<?php
//データベース処理ファイル
require_once('../models/dbc.php');

//ログイン処理ファイル
require_once('../controllers/signin.php');

//エラーメッセージ
$errors = check_login();

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="./css/style.css" rel="stylesheet">
      <title>ログイン</title>
  </head>
  <body>
      <div class="container">
        <div class="wrapper">
           <form action="login.php" method="post" class="form-signin">
              <h2 class="form-signin-heading">ログインフォーム</h2>
                <hr class="colorgraph"><br>
                <?php if( !empty($errors)): ?>
                  <ul class="error_list">
                    <?php foreach( $errors as $msg ): ?>
                      <li><?php echo $msg; ?></li><br>
                    <?php endforeach; ?>
                  </ul>
                  <?php endif; ?>
                  <input type=" text" class="form-control" name="email" placeholder="メールアドレス" autofocus=""><br>
                  <input type="password" class="form-control" name="password" placeholder="パスワード">
                  <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">ログイン</button><br>
                  <a href="register.php">
                  <h3 class="register">会員登録はこちら</h3></a><br>
                  <h3><center><a href="bbs.php">投稿一覧へ戻る</a></center></h3>
                </a>
            </form>
          </div>
        </div>
     </body>
</html>