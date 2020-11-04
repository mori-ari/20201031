<?php
session_start();
require_once('../inc/funcs.php');
// ログインチェック処理
sessionCheck();

//1. SESSIONデータ取得
$uid =$_SESSION['uid'];
$bookname =$_SESSION['bookname'];
$img_url =$_SESSION['img_url'];
$book_url =$_SESSION['book_url'];
$review =$_SESSION['review'];


$pdo = db_conn();
//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM book_list JOIN gs_user_table ON book_list.uid=gs_user_table.uid");
// $stmt = $pdo->prepare("SELECT * FROM book_list");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sql_error($status);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) { 
    $view .= '<div class="book_flex">';
    $view .= '<img class="book_size" src="'.$result['img_url'].'">';
    $view .= '<div class="balloon_off" id="'.$result['id'].'">';
    $view .= '<div class="close"><span class="batsu"></span></div>';
    $view .= '<div>'.$result['name'].'のおすすめ</div>';    
    $view .= '<a href="'.$result['book_url'].'" target="_blank"><p class="balloon_p">'.$result['bookname'].'</p></a>';
    $view .= '<p>レビュー：'.$result['review'].'</p>';
    $view .= '<a href="detail.php?id='. $result["id"].'"><button class="btn">修正</button></a>';
    $view .= '<a href="delete.php?id='. $result["id"].'"><button class="btn">削除</button></a>';
    $view .= '</div>';
    $view .= '</div> ';  
   }
}




?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/20201031/css/reset.css" />
    <link rel="stylesheet" href="/20201031/css/style.css" />
    <script src="/20201031/js/jquery-2.1.3.min.js"></script>
    <title>みんなの本棚</title>
</head>

<body>
  <?php include('../inc/header_login.php');?>
    <div id="main">
    
      <h1>みんなの本棚</h1>

      <p class="text">本をクリックすると編集／削除ができます</p>


<div class="nav_box">
<a href="index.php"><div id="bt_return">本を登録</div></a>
</div>


      <div id="bg_book">
    <div id="bg_book_inbox">
    <?= $view ?>


   <!-- <div class="book_flex" id="balloonoya" onclick="showBalloon()">
  <img class="book_size"  src="●●●">
  <span class="balloon_off" id="makeImg">
      <p>タイトル：●●●</p>
      <p>レビュー：●●●</p>
    <button><a href="●●●" target="_blank">詳細へ</a></button>

  <button>閉じる</button>
</span>
</div>  -->



</div>
</div>









</div>



<?php include('../inc/footer.php');?>



<script>

$('.book_flex').click(function(){
    $('.balloon').addClass('balloon_off').removeClass('balloon');
    $('.balloon_off',this).addClass('balloon').removeClass('balloon_off');
  });
   $('.close').click(function(){
    event.stopPropagation();
    $(this).parent().addClass('balloon_off').removeClass('balloon');
  });

  もし本のID

</script>

</body>
</html>
