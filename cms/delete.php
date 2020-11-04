<?php
session_start();
require_once('../inc/funcs.php');
// ログインチェック処理
sessionCheck();

$uid = $_GET['uid'];
$pdo = db_conn();
//３．データ登録SQL作成
$stmt = $pdo->prepare('DELETE FROM gs_user_table WHERE uid=:uid');
$stmt->bindValue(':uid', h($uid), PDO::PARAM_INT);      //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行
//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} 
// else {
//     redirect('select.php');
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
    <title>削除完了</title>
</head>

<body>
<?php include('../inc/header_login.php');?>
    <div id="main">
    
    <h1>ユーザーの削除が完了しました</h1>

<!-- <p class="text">次に本棚に置く本を選びましょう。</p> -->

<div class="nav_box">
<a href="select.php"><input id="submit" value="ユーザー一覧に戻る"></a>
</div>
</div>  

</div>

<?php include('../inc/footer.php');?>
</body>
</html>


