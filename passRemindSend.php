<?php
$siteTitle = 'パスワード再設定画面';
 require("head.php");

?>

<body class="page-login page-1colum">

  <!-- ヘッダー  -->
  <header>
    <div class="site-width">
      <h1><a href="index.html">memopa</a></h1>
      <nav id="top-nav">
        <ul>
          <li><a href="login.html">ログイン</a></li>
          <li><a href="signup.html">サインアップ</a></li>
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