
<header>
  <div class="site-width">
    <h1><a href="myMemo.php">memopa</a></h1>
    <nav id="top-nav">
      <ul>
<?php
if (empty($_SESSION['user_id'])) {
    ?>
      <li><a href="login.php">ログイン</a></li>
      <li><a href="signup.php">新規会員登録</a></li>
<?php
}else{
    ?>
      <li><a href="list.html">リストを作成</a></li>
      <li><a href="">ログアウト</a></li>
      <li><a href="myProf.html">マイプロフ</a></li>
<?php
}
?>
      </ul>
    </nav>
  </div>
</header>

