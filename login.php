<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery-2.1.3.min.js"></script>
    <title>ログイン</title>
      <style>

      </style>
  </head>
  <body>
  <?php include('inc/header.php');?>

    <div id="main">

      <h1>ログイン</h1>
      <form action="login_act.php" method="POST">
        <table>
         <tr>
            <td class="td"><label for="lid">ユーザー名</label></td>
            <td><input type="text" placeholder="半角英数3文字以上" class="width" id="lid" name="lid" required></td>
        </tr>
        <tr>
            <td class="td"><label for="lpw">パスワード</label></td>
            <td><input type="password" placeholder="半角英数6文字以上" class="width" id="lpw" name="lpw" pattern="^([a-zA-Z0-9]{6,})$" title="半角英数6文字以上で入力" required></td>
        </tr>
        </table>
                <div class="nav_box"><input id="submit" type="submit" value="ログイン"></div>
                <a href="cms/index.php"><div style="margin-top:20px" id="bt_return">新規登録はこちら</div></a>
      </form>

      </div>

      <?php include('inc/footer.php');?>


  </body>
</html>

