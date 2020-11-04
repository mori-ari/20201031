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
$name =$_SESSION['name'];

// var_dump($name);


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
   $login_name = '<div id="name">'. $name.'</div>';
}

?>


<!-- ヘッダー -->
<div id="header">
    <div id="header_inbox">
    <a href="/20201031/cms/select.php"><div id="allow"></div></a>
        <div id="room">ユーザー一覧</div>
        <?= $login_name ?>

        <a href="/20201031/logout.php"><div id="login">ログアウト</div></a>
    </div>
</div>