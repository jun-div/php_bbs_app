<?php

//退会処理
function cancel_MemberShip()
{

    //退会ボタン押下時
    if (isset($_POST['cancel'])) {

        $username = $_POST['username'];

        //退会処理実行
        delete_user($username);

        //セッションを空に
        $_SESSION = array();

        //クッキー削除
        if (isset($_COOKIE["PHPSESSID"])) {
            setcookie("PHPSESSID", '', time() - 1800, '/');
        }

        //セッション破棄
        session_destroy();

        //投稿一覧へ
        header('Location: ./bbs.php');
        exit;
    }

}
