<?php
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　アカウント作成画面　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');


//==============================
//画面処理
//==============================
// 変数定義
$email = $_POST['email'];
$username = $_POST['username'];
$pass = $_POST['pass'];
$pass_re = $_POST['pass_re'];

// 未入力チェック
if(!empty ($_POST)){
  varidRequired($email, 'email');
  varidRequired($username, 'username');
  varidRequired($pass, 'pass');
  varidRequired($pass_re, 'pass_re');

}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>アカウント作成ページ | memopa</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<body class="page-login page-1colum">

  <!-- ヘッダー  -->
  <header>
    <div class="site-width">
      <h1><a href="index.html">memopa</a></h1>
      <nav id="top-nav">
        <ul>
          <li><a href="top.html">トップ</a></li>
          <li><a href="login.html">ログイン</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- メインコンテンツ -->
  <div id="contents" class="site-width">

    <!-- Main -->
    <section id="main">
      <div class="form-container">
        <form action="" method="post" class="form">
          <h2 class="title">アカウント作成</h2>

          <div class="area-msg">
            
          </div>
          <!-- メールアドレス -->
          <label class="">メールアドレス</label>
          <input type="text" name="email" value="<?php if (!empty($_POST['email'])) echo $_POST['email']; ?>">
          <div class="area-msg">
           <?php 
            if(!empty($err_msg['email'])) echo $err_msg['email'];
            ?>
          </div>

          <!-- ユーザー名 -->
          <label class="username">ユーザー名</label>
          
          <input type="text" name="username" placeholder="サイトで使う名前を入力してください" value="<?php if (!empty($_POST['username'])) echo $_POST['username']; ?>">
<?php  ?>
          <div class="area-msg">
           <?php 
            if(!empty($err_msg['username'])) echo $err_msg['username'];
            ?>
          </div>

          <!-- パスワード -->
          <label class="pass">パスワード</label>
          <input type="password" name="pass" placeholder="６文字以上で入力してください。" value="<?php if (!empty($_POST['pass'])) echo $_POST['pass']; ?>">
          <div class="area-msg">
           <?php 
            if(!empty($err_msg['pass'])) echo $err_msg['pass'];
            ?>
          </div>


          <!-- パスワード（再入力） -->
          <label class="pass pass_re">パスワード（再入力）</label>
          <input type="password" name="pass_re" placeholder="６文字以上で入力してください。" value="<?php if (!empty($_POST['pass_re'])) echo $_POST['pass_re']; ?>">
          <div class="area-msg">
           <?php 
            if(!empty($err_msg['pass_re'])) echo $err_msg['pass_re'];
            ?>
          </div>


          <div class="checkbox01">
            <label>
              <input type="checkbox" name="pass_save" class="checkbox01-input">
              <span class="checkbox01-parts">次回ログインを省略する</span>
            </label>
          </div>

          <div class="btn-container">
            <input type="submit" class="btn btn-mid" value="作成">
          </div>

          
        </form>
      </div>
    </section>

  </div>

  <!-- footer -->
  <footer id="footer">
    Copyright memopa. All Rights Reserved.
  </footer>

  <!-- innnerHeightに関しての参考記事→ https://www.flatflag.nir87.com/height-1083 -->
  <!-- innerHeight = 要素＋padding(borderの内側)を取得 -->
  <!-- outerHeight = 要素＋padding+borderを取得 -->
  <!-- window ＝ 画面上に出てくる小さい画面のこと-->
  <script> src = "js/vendor/jquery-3.4.1.min.js"</script>
  <script>
    $(function () {
      var $ftr = $('#footer');
      if (window.innerHeight() > $ftr.offset().top + $ftr.outerHeight()) {
        $ftr.attr({ 'style': 'position: fixed; top:' + (window.innerHeight - $ftr.outerHeight()) + 'px;' });
      }
    });
  </script>

</body>

</html>