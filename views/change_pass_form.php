<?php
require_once('../models/dbc.php');

require_once('../controllers/signin.php');

require_once('../controllers/change_pass.php');
  

  $email = $_SESSION['email'];
  //エラーメッセージ
  $errors = change_pass();
 
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="./css/style.css" rel="stylesheet">
      <title>パスワード変更</title></title>
  </head>
  <body>
      <div class="container">
        <div class="wrapper">
           <form action="change_pass_form.php" method="post" class="form_setting">
              <h2 class="form-setting-heading">パスワード変更</h2>
                 <hr class="colorgraph"><br>
                 <?php if( !empty($errors)): ?>
                  <ul class="error_list">
                    <?php foreach( $errors as $msg ): ?>
                      <li><?php echo $msg; ?></li><br>
                    <?php endforeach; ?>
                  </ul>
                  <?php endif; ?>
                    <input type="hidden" name="email" value="<?php echo $email ?>">
                    <input type="password" class="form-control" name="password"  placeholder="パスワード" autofocus="">
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" name="change_pass" type="submit">変更する</button><br>
                    <h3><center><a href="bbs.php">投稿一覧へ戻る</a></center></h3>
              </form>
          </div>
        </div>
     </body>
</html>