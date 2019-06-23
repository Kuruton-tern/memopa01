<?php
$siteTitle = '退会画面';
 require("head.php");

?>

<body class="page-login page-1colum">

<style>
    .form .btn{
      float: none;
    }
  
    .form{
      text-align: center;
    }
  </style>


  <!-- ヘッダー  -->
  <header>
    <div class="site-width">
      <h1><a href="index.html">memopa</a></h1>
      <nav id="top-nav">
        <ul>
          <li><a href="mymemo.html.html">マイメモ</a></li>
          <li><a href="">ログアウト</a></li>
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
          <h2 class="title">退会</h2>

          <div class="area-msg">
            下の「退会」ボタンを押すと二度と情報の復元はできません。
            よろしいですか？
          </div>
        <!-- 退会ボタン -->
          <div class="btn-container">
            <input type="submit" class="btn btn-mid" value="退会">
          </div>
        
        </form>
      </div>
    </section>

  </div>

 <?php
 require('footer.php');
 ?>