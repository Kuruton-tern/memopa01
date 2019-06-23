<?php
$siteTitle = 'パスワード変更画面';
 require("head.php");

?>

<body class="page-login page-1colum">

  <!-- ヘッダー  -->
  <header>
    <div class="site-width">
      <h1><a href="index.html">memopa</a></h1>
      <nav id="top-nav">
        <ul>
          <li><a href="myProf.html">マイプロフ</a></li>
          <li><a href="myMemo.html">マイメモ</a></li>
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
          <h2 class="title">パスワード変更</h2>

          <div class="area-msg">

          </div>
          <!-- 旧メールアドレス -->
          <label class="">旧メールアドレス</label>
          <input type="password" name="email">

          <!-- 新メールアドレス -->
          <label class="">新メールアドレス</label>
          <input type="password" name="email">

          <!-- 新メールアドレス（再入力） -->
          <label class="">新メールアドレス（再入力）</label>
          <input type="password" name="email">

          <div class="btn-container">
            <input type="submit" class="btn btn-mid" value="変更">
          </div>
        </form>
      </div>
    </section>

  </div>

  <?php
 require('footer.php');
?>