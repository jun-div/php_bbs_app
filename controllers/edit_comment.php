<?php

//投稿内容編集
function edit_comment(){

  //内容更新ボタン押下時
  if(isset($_POST['edit_comment'])){

    
    //入力された値を各々の変数に格納
    $comment_id = $_POST['comment_id'];//投稿ID
    $comment_content = $_POST['edit_comment_content'];//編集内容

    //エラーメッセージ
    $errors = array();

    //コメントが入力されていない場合
    if(empty($comment_content)){

      $errors[] = "※更新内容を入力してください。";
      return $errors;
      header('Location: ./edit_comment_form.php');
      exit;

    }elseif(mb_strlen($comment_content) >= 100){

      $errors[] ="※更新内容は100文字以内で入力してください。";
      return $errors;
      header('Location: ./edit_comment_form.php');
      exit;

    }else{

    //投稿内容更新処理へ
    update_comment_content($comment_id,$comment_content);

    header('Location: ./bbs.php');
    exit;

  }


  }
}
?>