<?php
//データベース
require_once('../models/dbc.php');

//会員登録ファイル呼び出し
require_once('../controllers/signup.php');

//会員登録のエラーメッセージ
$errors = check_entry();


?>
<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="./css/style.css" rel="stylesheet">
      <title>会員登録</title>
  </head>
  <body>
      <div class="container">
        <div class="wrapper">
           <form action="register.php" method="post" class="form-signup">
              <h2 class="form-signup-heading">会員登録フォーム</h2>
                 <hr class="colorgraph"><br>
                 <?php if( !empty($errors)): ?>
                  <ul class="error_list">
                    <?php foreach( $errors as $msg ): ?>
                      <li><?php echo $msg; ?></li><br>
                    <?php endforeach; ?>
                  </ul>
                  <?php endif; ?>
                  <input type=" text" class="form-control" name="username" placeholder="ユーザー名"  autofocus=""><br>
                  <input type=" text" class="form-control" name="email" placeholder="メールアドレス"><br>
                  <input type="password" class="form-control" name="password" placeholder="パスワード">
                  <button class="btn btn-lg btn-primary btn-block" name="signup" type="submit">会員登録</button><br>
                  <h3><center><a href="bbs.php">投稿一覧へ戻る</a></center></h3>
            </form>
          </div>
        </div>
     </body>
</html>