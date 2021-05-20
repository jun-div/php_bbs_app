<?php

//データベース接続処理
function dbConnect()
{

    try {
        //DB設定ファイル呼び出し
        require '../core/config.php';

        //PDOクラスのインスタンス生成とデータベース接続設定
        $pdo = new PDO($dsn, $user, $pass);

        //エラー発生時の例外を投げる準備
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        echo '接続失敗' . $e->getMessage();
        exit();
    }

    return $pdo;

}

//データベース内のユーザー名重複チェック
function check_name($username)
{

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してデータベース内の重複するユーザー名を取得
        $sql = "SELECT user_name FROM bbs.users WHERE user_name = :username";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        //SQL実行
        $stmt->execute();

        //該当するユーザー名があれば配列で取得（カラム名のみ）
        $array = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        echo '検索失敗' . $e->getMessage();
        exit();
    }

    return $array;

}

//データベース内のメールアドレス重複チェック
function check_email($email)
{

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してデータベース内の重複するメールアドレスを取得
        $sql = "SELECT email FROM bbs.users WHERE email = :email";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        //SQL実行
        $stmt->execute();

        //該当するメールアドレスがあれば配列で取得（カラム名のみ）
        $array = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        echo '検索失敗' . $e->getMessage();
        exit();
    }

    return $array;

}

//会員登録処理
function entry($username, $email, $password)
{

    //時刻設定
    date_default_timezone_set('Asia/Tokyo');
    //時刻取得
    $date = date('Y-m-d H:i:s');
    echo $date;

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してSQL文作成
        $sql = "INSERT IGNORE INTO bbs.users(user_name,email,password,created_at)VALUES(:username,:email,:password,:date)";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);

        //SQL実行
        $stmt->execute();

    } catch (PDOException $e) {

        echo '登録失敗' . $e->getMessage();
        exit();
    }
}

//ログイン処理
function login($email)
{

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してSQL文作成
        $sql = "SELECT * FROM bbs.users WHERE email = :email";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        //SQL実行
        $stmt->execute();

        //該当するメールアドレスがあれば配列でデータ取得（カラム名のみ）
        $array = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        echo 'ログイン失敗' . $e->getMessage();
        exit();
    }

    return $array;

}

//ユーザー情報取得
function select_user($username)
{

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してSQL文作成
        $sql = "SELECT * FROM bbs.users WHERE user_name = :user_name";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':user_name', $username, PDO::PARAM_STR);

        //SQL実行
        $stmt->execute();

        //ユーザー名をもとに配列でデータ取得（カラム名のみ）
        $array = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        echo '取得失敗' . $e->getMessage();
        exit();
    }

    return $array;

}

//会員情報変更(ユーザー名、メールアドレス)
function update_user($username, $email, $user_id)
{

    //時刻設定
    date_default_timezone_set('Asia/Tokyo');
    //時刻取得
    $date = date('Y-m-d H:i:s');

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してSQL文作成
        $sql = "UPDATE bbs.users
          SET
          user_name = :username ,
              email = :email,
         updated_at = :date
         WHERE
            user_id = :user_id;";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);

        //SQL実行
        $stmt->execute();

    } catch (PDOException $e) {

        echo '更新失敗' . $e->getMessage();
        exit();
    }

}

//パスワード変更処理
function update_pass($password, $email)
{

    //時刻設定
    date_default_timezone_set('Asia/Tokyo');
    //時刻取得
    $date = date('Y-m-d H:i:s');

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してSQL文作成(削除フラグ更新)
        $sql = "UPDATE bbs.users
          SET
          password = :password,
        updated_at = :date
       WHERE email = :email";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);

        //SQL実行
        $stmt->execute();

    } catch (PDOException $e) {

        echo '更新失敗' . $e->getMessage();
        exit();
    }

}

//退会処理
function delete_user($username)
{

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してSQL文作成
        $sql = "DELETE FROM bbs.users WHERE user_name = :username";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        //SQL実行
        $stmt->execute();

    } catch (PDOException $e) {

        echo '削除失敗' . $e->getMessage();
        exit();
    }

}

//投稿内容登録処理
function post_registration($username, $post_content)
{

    //時刻設定
    date_default_timezone_set('Asia/Tokyo');
    //時刻取得
    $date = date('Y-m-d H:i:s');

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してSQL文作成
        $sql = "INSERT IGNORE INTO bbs.posts(user_name,post_content,created_at)VALUES(:username,:post_content,:date)";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':post_content', $post_content, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);

        //SQL実行
        $result = $stmt->execute();

        //var_dump($result);

    } catch (PDOException $e) {

        echo '登録失敗' . $e->getMessage();
        exit();
    }

}

//投稿内容一覧取得
function select_post_list()
{

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してSQL文作成
        $sql = "SELECT * FROM bbs.posts";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //SQL実行
        $stmt->execute();

        //配列でデータ取得
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        echo '取得失敗' . $e->getMessage();
        exit();
    }

    return $array;

}

//コメント内容登録処理
function comment_registration($username, $parent_id, $parent_content, $comment_content)
{

    //時刻設定
    date_default_timezone_set('Asia/Tokyo');
    //時刻取得
    $date = date('Y-m-d H:i:s');

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してSQL文作成
        $sql = "INSERT IGNORE INTO bbs.comments(user_name,parent_id,parent_content,comment_content,created_at)VALUES(:username,:parent_id,:parent_content,:comment_content,:date)";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
        $stmt->bindParam(':parent_content', $parent_content, PDO::PARAM_STR);
        $stmt->bindParam(':comment_content', $comment_content, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);

        //SQL実行
        $result = $stmt->execute();

    } catch (PDOException $e) {

        echo '登録失敗' . $e->getMessage();
        exit();
    }

}

//コメント内容一覧取得
function select_comment_list()
{

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してSQL文作成
        $sql = "SELECT * FROM bbs.comments";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //SQL実行
        $stmt->execute();

        //配列でデータ取得
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        echo '取得失敗' . $e->getMessage();
        exit();
    }

    return $array;

}

//IDを条件に指定された親記事内容取得
function select_post_content($post_id)
{

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してデータベース内の親記事をIDで取得
        $sql = "SELECT post_content FROM bbs.posts WHERE post_id = :post_id";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);

        //SQL実行
        $stmt->execute();

        //配列で取得（カラム名のみ）
        $array = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        echo '検索失敗' . $e->getMessage();
        exit();
    }

    return $array;

}

//投稿内容と親記事内容更新
function update_post_content($post_id, $post_content)
{

    //時刻設定
    date_default_timezone_set('Asia/Tokyo');
    //時刻取得
    $date = date('Y-m-d H:i:s');

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してSQL文作成
        //親記事の更新
        $sql = "UPDATE bbs.posts
          SET
          post_content = :post_content,
            updated_at = :date
         WHERE post_id = :post_id";

        //プレースホルダを利用してSQL文作成
        //コメントテーブルの親記事更新
        $sql1 = "UPDATE bbs.comments
    SET
    parent_content = :parent_content
   WHERE parent_id = :parent_id";

        // トランザクション開始
        $pdo->beginTransaction();

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':post_content', $post_content, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);

        //SQL実行
        $stmt->execute();

        //SQL実行準備
        $stmt1 = $pdo->prepare($sql1);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt1->bindParam(':parent_content', $post_content, PDO::PARAM_STR);
        $stmt1->bindParam(':parent_id', $post_id, PDO::PARAM_INT);

        //SQL実行
        $stmt1->execute();

        //コミット（処理完了）
        $pdo->commit();

    } catch (PDOException $e) {
        //ロールバック(処理の中断と無効化)
        $pdo->rollBack();
        echo '更新失敗' . $e->getMessage();
        exit();
    }

}

//postsテーブルの削除フラグ更新（論理削除）
function update_post_flag($post_id)
{

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してSQL文作成(削除フラグ更新)
        $sql = "UPDATE bbs.posts
          SET
          delete_flag = 1
         WHERE post_id = :post_id";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);

        //SQL実行
        $stmt->execute();

    } catch (PDOException $e) {

        echo '更新失敗' . $e->getMessage();
        exit();
    }

}

//IDを条件に指定されたコメント内容取得
function select_comment_content($comment_id)
{

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してデータベース内の親記事をIDで取得
        $sql = "SELECT comment_content FROM bbs.comments WHERE comment_id = :comment_id";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);

        //SQL実行
        $stmt->execute();

        //配列で取得（カラム名のみ）
        $array = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        echo '検索失敗' . $e->getMessage();
        exit();
    }

    return $array;

}

//コメント内容更新
function update_comment_content($comment_id, $comment_content)
{

    //時刻設定
    date_default_timezone_set('Asia/Tokyo');
    //時刻取得
    $date = date('Y-m-d H:i:s');

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してSQL文作成
        //親記事の更新
        $sql = "UPDATE bbs.comments
          SET
          comment_content = :comment_content,
            updated_at = :date
         WHERE comment_id = :comment_id";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':comment_content', $comment_content, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);

        //SQL実行
        $stmt->execute();

    } catch (PDOException $e) {

        echo '更新失敗' . $e->getMessage();
        exit();
    }

}

//commentsテーブルの削除フラグ更新（論理削除）
function update_comment_flag($comment_id)
{

    //データベース接続処理呼び出し
    $pdo = dbConnect();

    try {

        //プレースホルダを利用してSQL文作成(削除フラグ更新)
        $sql = "UPDATE bbs.comments
          SET
          delete_flag = 1
         WHERE comment_id = :comment_id";

        //SQL実行準備
        $stmt = $pdo->prepare($sql);

        //bindParamで実際の値をプレースホルダにバインド
        $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);

        //SQL実行
        $stmt->execute();

    } catch (PDOException $e) {

        echo '更新失敗' . $e->getMessage();
        exit();
    }

}
