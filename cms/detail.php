<?php
session_start();
require_once('../inc/funcs.php');
// ログインチェック処理
sessionCheck();
//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
$uid = $_GET['uid'];
// echo ($id);
//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
$pdo = db_conn();
//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table
                       WHERE uid=".$uid);
$status = $stmt->execute();
//３．データ表示
$view = "";
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/20201031/css/reset.css" />
    <link rel="stylesheet" href="/20201031/css/style.css" />
    <script src="/20201031/js/jquery-2.1.3.min.js"></script>
    <title>ユーザー情報修正</title>
  </head>
  <body>

  <?php include('../inc/header_login.php');?>

    <div id="main">

      <h1>ユーザー情報修正</h1>
      <form action="update.php" method="post">
        <table>
         <tr>
            <td class="td"><label for="name">ニックネーム</label></td>
            <td><input type="text" placeholder="(例)山田 太郎" class="width" id="name" name="name" value="<?= $result['name']?>" required></td>
        </tr>
        <tr>
            <td class="td"><label for="lid">ユーザーID</label></td>
            <td><input type="text" placeholder="半角英数3文字以上" pattern="^([a-zA-Z0-9]{3,})$" title="半角英数字3文字以上で入力して下さい" class="width" id="lid" name="lid" value="<?= $result['lid']?>" required></td>
        </tr>
        <tr>
            <td class="td"><label for="lpw">パスワード</label></td>
            <td><input type="password" pattern="^([a-zA-Z0-9]{6,})$" title="半角英数6文字以上で入力" class="width" id="lpw" name="lpw" value="<?= $result['lpw'] ?>" required></td>
        </tr>
        <tr>
        <td class="td"><label for="kanri_flg">管理者権限</label></td>
        <td><input type="radio" name="kanri_flg"<?= $result['kanri_flg']==0 ? 'checked' : '' ?> value="0" required>一般社員
        <input type="radio" name="kanri_flg" <?= $result['kanri_flg']==1 ? 'checked' : '' ?> value="1">管理者</td>            
    </tr>
        <tr>
        <td class="td"><label for="life_flg">退職フラグ</label></td>
        <td><input type="hidden" name="life_flg" value="0">
          <input type="checkbox" name="life_flg"<?= $result['life_flg']==1 ? 'checked' : '' ?> value="1">退職済み</td>         
    </tr>

        </table>
        <input type="hidden" name="uid" value='<?= $result['uid'] ?>'>
        <input type="hidden" name="indate" value='<?= $result['indate'] ?>'>

        <div class="nav_box">
          <a href="select.php"><div id="bt_return">戻る</div></a>
          <div class="nav_box"><input id="submit" type="submit" value="修正"></div>
        </div> 

      </form>

      </div>

      <?php include('../inc/footer.php');?>


  </body>
</html>
