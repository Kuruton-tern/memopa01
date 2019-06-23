
<?php
$siteTitle = 'ログイン画面';
 require("head.php");
?>

<body class="page-logined page-1colum">

<!-- ヘッダー  -->
<header>
  <div class="site-width">
    <h1><a href="myMemo.html">memopa</a></h1>
    <nav id="top-nav">
      <ul>
        <li><a href="top.html">トップ</a></li>
        <li><a href="signup.html">新規会員登録</a></li>
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
          <h2 class="title">ログイン</h2>

          <div class="area-msg">
            メールアドレスまたはパスワードが違います。
          </div>
          <!-- メールアドレス -->
          
            <label class="">メールアドレス</label>
            <input type="text" name="email">
        
          <!-- パスワード -->
            <label class="">パスワード</label>
            <input type="password" name="pass" placeholder="６文字以上で入力してください。">
        
            <div class="checkbox01">
              <label>
                <input type="checkbox" name="pass_save" class="checkbox01-input">
                <span class="checkbox01-parts">次回ログインを省略する</span>
              </label>
            </div>

          <div class="btn-container">
            <input type="submit" class="btn btn-mid" value="ログイン">
          </div>
          <span class="help-block">
            パスワードを忘れた方は<a href="passRemindSend.html">コチラ</a>
          </span>
        </form>
    </div>
</section>

</div>

<?php
 require('footer.php');
 ?>