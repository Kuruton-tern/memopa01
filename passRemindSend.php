<?php
$siteTitle = 'パスワード再設定画面';
 require("head.php");

?>

<body class="page-login page-1colum">

  <!-- ヘッダー  -->
<?php 
require('header.php');
?>

  <!-- メインコンテンツ -->
  <div id="contents" class="site-width">

    <!-- Main -->
    <section id="main">
      <div class="form-container">
        <form action="" method="post" class="form">
          <h2 class="title">パスワード再設定</h2>

          <div class="area-msg">
            エラー：ご登録のないメールアドレスです。
          </div>
          <!-- メールアドレス -->
          <label class="">メールアドレス</label>
          <input type="text" name="email">

          <div class="btn-container">
            <input type="submit" class="btn btn-mid" value="送信">
          </div>
        </form>
      </div>
    </section>

  </div>

  <?php
 require('footer.php');
?>