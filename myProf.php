<?php
$siteTitle = 'マイプロフ';
 require("head.php");

?>

<body class="page-logined page-2colum page-profEdit">

  <!-- ヘッダー  -->
  <header>
    <div class="site-width">
      <h1><a href="index.html">memopa</a></h1>
      <nav id="top-nav">
        <ul>
          <li><a href="">ログアウト</a></li>
          <li><a href="myMemo.html">マイメモ</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- メインコンテンツ -->
  <div id="contents" class="site-width">
    
    <!-- main -->
    <section id="main" class="prof">
      <div class="form-container prof-form">
        <h2 class="title">アカウント情報</h2>
        
        <form action="" class="form">
          <div class="area-msg">
            ユーザー名は日本語のみ使用できます。
            メールアドレスが適切ではありません。
          </div>
          <!-- アバター写真 -->
          <div class="prof-img">
           <img src="img/me01.png" alt="">
          </div>
          
          <!-- ユーザー名 -->
          <label class="">ユーザー名</label>
            <input type="text" name="username" id="">
            
            <!-- メールアドレス -->
            <label class="">メールアドレス</label>
              <input type="text" name="email" id="">
              
              <div class="btn-container">
                <input type="submit" class="btn btn-mid" value="変更">
              </div>
              
          </form>
      </div>
    </section>
    
    <!-- サイドバー -->
    <section class="sidebar">
      
      <a href="memoContents.html">メモを投稿する</a>
      <a href="myProf.html">プロフィール編集</a>
      <a href="passEdit.html">パスワード変更</a>
      <a href="withdraw.html">退会</a>
    </section> 

  </div>
  
  <?php
 require('footer.php');
?>