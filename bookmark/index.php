<?php
session_start();
require_once('../inc/funcs.php');
// ログインチェック処理
sessionCheck();

//1. SESSIONデータ取得
$uid=$_SESSION["uid"];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/20201031/css/reset.css" />
    <link rel="stylesheet" href="/20201031/css/style.css" />
    <script src="/20201031/js/jquery-2.1.3.min.js"></script>
    <title>本を登録</title>
      <style>

      </style>
  </head>
  <body>
  <?php include('../inc/header_login.php');?>

    <div id="main">

      <h1>おすすめの本を登録</h1>
      <form action="confirm.php" method="post">
        <table>
         <tr>
            <td class="td"><label for="bookname">本のタイトル</label></td>
            <td><input type="text" placeholder="本のタイトルを入力してください" class="width" id="bookname" name="bookname" required></td>
        </tr>
        <tr>
            <td class="td"><label for="img_url">画像URL</label></td>
            <td><input type="url" placeholder="(例)http://www/gsbooks.com/img.jpg" class="width" id="img_url" name="img_url" required></td>
        </tr>
        <tr>
            <td class="td"><label for="book_url">詳細URL</label></td>
            <td><input type="url" placeholder="(例)http://www/gsbooks.com/book.html" class="width" id="book_url" name="book_url" required></td>
        </tr>
          <tr>
            <td class="td"><label for="review">一言レビュー</label></td>
            <td><textarea rows="3" cols="40" id="review" placeholder="(例)今年一番面白かった！" name="review"></textarea></td>            
        </tr>
        </table>
        <input type="hidden" name="uid" value="<?= $uid ?>">
        <div class="nav_box"><input id="submit" type="submit" value="本を登録"></div>
        <a href="select.php"><div style="margin-top:20px" id="bt_return">本棚へ戻る</div></a>
      </form>

      </div>

      <?php include('../inc/footer.php');?>


  </body>
</html>

