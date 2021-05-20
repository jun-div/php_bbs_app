<?php
//ログアウト処理
function logout(){

  //ログアウトボタン押下時
  if(isset($_POST['logout'])){

    //セッションを空に
    $_SESSION = array();

    //クッキー削除
    if(isset($_COOKIE["PHPSESSID"])){
        setcookie("PHPSESSID",'',time()-1800,'/');
    }

    //セッション破棄
    session_destroy();

    //投稿一覧へ
    header('Location: ./bbs.php');
  
  }

}
?>