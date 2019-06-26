
<header>
  <div class="site-width">
    <h1><a href="top.php">memopa</a></h1>
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
      <li><a href="list.php">リストを作成</a></li>
      <li><a href="logout.php">ログアウト</a></li>
      <li><a href="myProf.php">マイプロフ</a></li>
<?php
}
?>
      </ul>
    </nav>
  </div>
</header>

