<?php

//コメント削除
function delete_comment(){

  //投稿削除ボタン押下時
  if(isset($_POST['delete_comment'])){

    //投稿IDを変数に格納
    $comment_id = $_POST['comment_id'];

    //削除フラグ更新（論理削除）
    update_comment_flag($comment_id);

    header('Location: ./bbs.php');
    exit;

  }
}

?>