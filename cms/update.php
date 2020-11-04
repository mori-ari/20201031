<?php
session_start();
require_once('../inc/funcs.php');
// ログインチェック処理
sessionCheck();

//1. POSTデータ取得
$name   =$_POST["name"];
$lid  =$_POST["lid"];
$lpw = $_POST["lpw"];
$kanri_flg    = $_POST["kanri_flg"];
$life_flg    = $_POST["life_flg"];
$indate    = $_POST["indate"];
$uid    = $_POST["uid"];
//2. DB接続します
//*** function化する！  *****************
// ※returnを変数にちゃんと入れる！
$pdo = db_conn();
//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE 
                            gs_user_table
                        SET
                        name = :name,
                        lid = :lid,
                            lpw = :lpw,
                            kanri_flg = :kanri_flg,
                            life_flg = :life_flg,
                            indate = sysdate()
                        WHERE
                            uid = :uid;
                        ");
$stmt->bindValue(':name', h($name), PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', h($lid), PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', h($lpw), PDO::PARAM_STR);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', h($kanri_flg), PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':life_flg', h($life_flg), PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':uid', h($uid), PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
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
    <title>ユーザー情報修正完了</title>
</head>

<body>
  <?php include('../inc/header_login.php');?>
    <div id="main">
    
    <h1>ユーザー情報の修正が完了しました</h1>

<!-- <p class="text">次に本棚に置く本を選びましょう。</p> -->

<div class="nav_box">
<a href="select.php"><input id="submit" value="ユーザー一覧に戻る"></a>
</div>
</div>  

</div>

<?php include('../inc/footer.php');?>
</body>
</html>


