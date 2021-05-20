<?php
require_once '../models/dbc.php';

require_once '../controllers/member.php';

require_once '../controllers/cancel_membership.php';

//会員情報取得
member_choice();

//セッションに保持した値を各々の変数に格納
$username = $_SESSION['user_name'];
$email = $_SESSION['email'];
$created_at = $_SESSION['created_at'];
$updated_at = $_SESSION['updated_at'];

//退会
cancel_MemberShip();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="./css/style.css" rel="stylesheet">
  <title>会員情報</title>
  </title>
</head>

<body>
  <div class="container">
    <div class="wrapper">
      <form action="user_info.php" method="post" class="form-user_info">
        <h2 class="form-user_info-heading">会員情報</h2>
        <hr class="colorgraph"><br>
        <h5>ユーザー名：</h5>
        <input type="text" class="form-control" name="username" disabled value="<?php echo $username; ?>">
        <h5>メールアドレス：</h5>
        <input type="text" class="form-control" name="email" disabled value="<?php echo $email; ?>">
        <h5>登録日時：</h5>
        <input type="text" class="form-control" name="created_at" disabled value="<?php echo $created_at; ?>">
        <h5>最終更新日時：</h5>
        <input type="text" class="form-control" name="updated_at" disabled value="<?php echo $updated_at; ?>"><br>
        <input type="button" class="btn btn-lg btn-primary btn-block" onclick="location.href='setting.php'"
          value="会員情報変更"><br>
        <input type="hidden" name="username" value="<?php echo $username ?>">
        <input type="submit" class="btn btn-lg btn-primary btn-block" name="cancel" onclick="return CancelMemberShip()"
          value="退会する"><br>
        <h3>
          <center><a href="bbs.php">投稿一覧へ戻る</a></center>
        </h3>
      </form>
    </div>
  </div>
  <script>
  //退会する押下時
  function CancelMemberShip() {

    var msg = confirm('退会します。よろしいですか？');

    //OKなら退会処理
    if (msg == true) {

      window.alert('退会しました。またきてね！');
      return true;

    } else {

      //キャンセルなら退会しない
      return false;

    }
  }
  </script>
</body>

</html>