<?php
$siteTitle = 'パスワード認証画面';
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
          <h2 class="title">認証ページ</h2>
          <p>ご指定のメールアドレスお送りした【パスワード再発行認証メール】内にある「認証キー」をご入力ください。</p>

          <div class="area-msg">
            
          </div>
          <!-- メールアドレス -->
          <!-- まだ認証キーのname決めてない -->
          <label class="">認証キー</label>
          <input type="text" name="">

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