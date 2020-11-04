<?php
session_start();
require_once('../inc/funcs.php');


//1. POSTデータ取得
$name =$_POST['name'];
$lid =$_POST['lid'];
$lpw =$_POST['lpw'];
$kanri_flg =$_POST['kanri_flg'];



//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
//2. DB接続します
$pdo = db_conn();


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_user_table(uid, name, lid, lpw,kanri_flg,indate)VALUES(NULL, :name, :lid, :lpw,:kanri_flg, sysdate())");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
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
    <title>ユーザー登録完了</title>
</head>

<body>
<?php include('../inc/header.php');?>
    <div id="main">
    
    <h1>ユーザー登録が完了しました</h1>

<!-- <p class="text">次に本棚に置く本を選びましょう。</p>


<img class="bg_tana" src="./img/1512.jpg"> -->






<!-- <form action="/select.php" method="post"> -->
<div class="nav_box">
<!-- <a href="select.php"><div id="bt_return">ユーザー一覧へ</div></a> -->
<a href="../login.php"><div id="submit">ログイン</div></a>
<!-- <div><input id="submit" type="submit" value="本棚編集へ"></div> -->
</div>
<!-- </form> -->
</div>  








</div>
<?php include('../inc/footer.php');?>
</body>
</html>


