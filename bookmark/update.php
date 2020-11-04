<?php
session_start();
require_once('../inc/funcs.php');
// ログインチェック処理
sessionCheck();

//1. POSTデータ取得
$bookname   = $_POST["bookname"];
$img_url  = $_POST["img_url"];
$book_url = $_POST["book_url"];
$review    = $_POST["review"];
$indate    = $_POST["indate"];
$id    = $_POST["id"];
//2. DB接続します
//*** function化する！  *****************
// ※returnを変数にちゃんと入れる！
$pdo = db_conn();
//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE 
                            book_list
                        SET
                            bookname = :bookname,
                            img_url = :img_url,
                            book_url = :book_url,
                            review = :review,
                            indate = sysdate()
                        WHERE
                            id = :id;
                        ");
$stmt->bindValue(':bookname', h($bookname), PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':img_url', h($img_url), PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_url', h($book_url), PDO::PARAM_STR);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':review', h($review), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', h($id), PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行
//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} 
// else {
//     redirect('index.php');
//     header('Location: select.php');
// }
?>


<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/20201031/css/reset.css" />
    <link rel="stylesheet" href="/20201031/css/style.css" />
    <script src="/20201031/js/jquery-2.1.3.min.js"></script>
    <title>修正完了</title>
</head>

<body>
<?php include('../inc/header_login.php');?>
    <div id="main">
    
    <h1>本の修正が完了しました</h1>

<!-- <p class="text">次に本棚に置く本を選びましょう。</p> -->

<div class="nav_box">
<a href="select.php"><input id="submit" value="本棚に戻る"></a>
</div>
</div>  

</div>

<?php include('../inc/footer.php');?>
</body>
</html>


