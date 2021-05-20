<?php

//投稿削除
function delete_post(){

  //投稿削除ボタン押下時
  if(isset($_POST['delete_post'])){

    //投稿IDを変数に格納
    $post_id = $_POST['post_id'];

    //削除フラグ更新（論理削除）
    update_post_flag($post_id);

    header('Location: ./bbs.php');
    exit;

  }
}

?>