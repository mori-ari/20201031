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

// $uid =$_POST['uid'];
// $bookname =$_POST['bookname'];
// $img_url =$_POST['img_url'];
// $book_url =$_POST['book_url'];
// $review =$_POST['review'];


//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
//2. DB接続します
$pdo = db_conn();
//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO book_list(id,uid, bookname, img_url, book_url,review, indate)VALUES(NULL,:uid, :bookname, :img_url, :book_url,:review, sysdate())");
$stmt->bindValue(':uid', $uid, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':img_url', $img_url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_url', $book_url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':review', $review, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
//４．データ登録処理後
if ($status == false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMessage:" . $error[2]);
} else {
  //５．index.phpへリダイレクト 
  // header('Location: select.php');

}
?>



<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/20201031/css/reset.css" />
    <link rel="stylesheet" href="/20201031/css/style.css" />
    <script src="/20201031/js/jquery-2.1.3.min.js"></script>
    <title>データ登録</title>
</head>

<body>
<?php include('../inc/header_login.php');?>
    <div id="main">
    
    <h1>本の登録が完了しました</h1>

<!-- <p class="text">次に本棚に置く本を選びましょう。</p>


<img class="bg_tana" src="./img/1512.jpg"> -->






<form action="select.php" method="post">
<div class="nav_box">
<a href="index.php"><div id="bt_return">次の本を登録</div></a>
<div><input id="submit" type="submit" value="本棚を見る"></div>
</div>
</form>
</div>  








</div>

<?php include('../inc/footer.php');?>
</body>
</html>


