<?php

//投稿処理
function post_data()
{

//投稿するボタンを押下した場合
    if (isset($_POST['write'])) {

        //ユーザー名
        $username = $_SESSION['user_name'];
        //投稿内容(エスケープ処理)
        $post_content = htmlspecialchars($_POST['post_content'], ENT_QUOTES);

        //エラーメッセージ用
        $errors = array();

        //投稿する内容が入力されていない場合
        if (empty($post_content)) {

            $errors[] = "※投稿する内容を入力してください。";
            return $errors;
            header('Location: ./write.php');
            exit;

            //投稿内容文字数チェック
        } elseif (mb_strlen($post_content) >= 100) {

            $errors[] = "※投稿内容は100文字以内で入力してください。";
            return $errors;
            header('Location: ./write.php');
            exit;

        } else {

            //投稿登録処理へ
            post_registration($username, $post_content);

            header('Location: ./bbs.php');
            exit;

        }
    }

}
