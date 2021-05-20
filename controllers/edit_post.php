<?php

//投稿内容編集
function edit_post(){

  //内容更新ボタン押下時
  if(isset($_POST['edit_post'])){

    
    //入力された値を各々の変数に格納
    $post_id = $_POST['post_id'];//投稿ID
    $post_content = $_POST['edit_post_content'];//編集内容

    //エラーメッセージ
    $errors = array();

    //コメントが入力されていない場合
    if(empty($post_content)){

      $errors[] = "※更新内容を入力してください。";
      return $errors;
      header('Location: ./edit_post_form.php');
      exit;

    }elseif(mb_strlen($post_content) >= 100){

      $errors[] ="※更新内容は100文字以内で入力してください。";
      return $errors;
      header('Location: ./edit_post_form.php');
      exit;

    }else{

    //投稿内容更新処理へ
    update_post_content($post_id,$post_content);

    header('Location: ./bbs.php');
    exit;

  }


  }
}
?>