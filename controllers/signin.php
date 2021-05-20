<?php

//セッション開始
session_start();

//ログイン
function check_login()
{

    //ログインボタンを押下した場合
    if (isset($_POST['login'])) {

        //送られてきたデータを各々の変数に格納
        $email = $_POST['email'];
        $password = $_POST['password'];
        //エラーメッセージを格納する変数
        $errors = array();

        //ユーザー名とメールアドレス空チェック
        if (empty($email) && empty($password)) {

            $errors[] = "※メールアドレスとパスワードを入力してください。";
            return $errors;
            header('Location: ./login.php');

        }

        //メールアドレス空チェック
        if (empty($email)) {

            $errors[] = "※メールアドレスを入力してください。";

        }

        //メールアドレス形式チェック
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $errors[] = "※メールアドレスを正しい形式で入力してください。";

        }

        //パスワード空チェック
        if (empty($password)) {

            $errors[] = "※パスワードを入力してください。";

        }

        //入力値チェックの結果、エラーメッセージありの場合
        if (!empty($errors)) {

            //エラーメッセージを返して登録画面へ
            return $errors;
            header('Location: ./login.php');
            exit;

        }

        //ログインチェック
        $result = login($email);

        //ログインチェックの結果、メールアドレスが登録されていない場合
        if (!isset($result['email'])) {

            $errors[] = "※メールアドレスまたはパスワードが間違っています。";
            return $errors;
            header('Location: ./login.php');

        }

        //入力されたパスワードとハッシュ化したパスワードが一致した場合
        if (password_verify($password, $result['password'])) {

            //セッションハイジャック対策
            session_regenerate_id();

            //ユーザー名とメールアドレスをサーバーに保持
            $_SESSION['user_name'] = $result['user_name'];
            $_SESSION['email'] = $result['email'];

            //投稿一覧画面へ
            header('Location: ./bbs.php');

        } else {

            $errors[] = "※メールアドレスまたはパスワードが間違っています。";
            return $errors;
            header('Location: ./login.php');

        }

    }
}
