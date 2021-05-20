<?php 
//require_once('../controllers/signin.php');
//session_start();

//親記事内容取得
function parent_data($parent_id){

  $post_id = $parent_id;
  //親記事取得
  $result = select_post_content($post_id);

  return $result;

}

//コメント登録処理
function comment_data(){


  //コメントするボタン押下時
  if(isset($_POST['comment'])){

    //入力された値を各々の変数に格納
    $username = $_SESSION['user_name'];//ユーザー名
    $parent_id = $_POST['post_id'];//親記事ID
    $parent_content = $_POST['parent_content'];//親記事
    $comment_content = htmlspecialchars($_POST['comment_content'],ENT_QUOTES);//コメント内容

    $errors = array();


    //コメントが入力されていない場合
    if(empty($comment_content)){

      $errors[] = "※コメントを入力してください。";
      return $errors;
      header('Location: ./comment_form.php');
      exit;

    }elseif(mb_strlen($comment_content) >= 100){

      $errors[] ="※投稿内容は100文字以内で入力してください。";
      return $errors;
      header('Location: ./comment_form.php');
      exit;

  }else{

    //コメント登録処理へ
    comment_registration($username,$parent_id,$parent_content,$comment_content);

    header('Location: ./bbs.php');
    exit;

  }
 }
}

?>
