<script>
//ログアウト押下時
function clickLogout(){
   
   var msg = confirm('ログアウトします。よろしいですか？');
    //OKならログアウト処理
   if(msg == true){
     
      window.alert('ログアウトしました。');
      return true;
     
   }else{
     //キャンセルならログアウトしない
      return false;

   }
}
</script>

<div class="header">
  <h1 class="title">投稿一覧</h1>
      <div class="navbar">
            <ul>
                <li>ようこそ<span><?php echo $username ?></span>さん！</li>
                <?php if(isset($_SESSION['user_name'])) :?>
                <form action ="user_info.php" method="post">
                <li><button  class="header_button" type="submit" name="mypage">マイページ</button></li>
                </form>
                <form action ="bbs.php" method ="post">
                <li><button  class="header_button" type="submit" name="logout" onclick="return clickLogout()">ログアウト</button></li>
                </form>
                <?php else :?>
                <li><input type="button"  class="header_button" onclick="location.href='login.php'" value="ログイン"></li>
                <li><input type="button"  class="header_button" onclick="location.href='register.php'" value="新規会員登録"></li>
                <?php endif;?>
            </ul>
      </div>
    <hr>
</div>