<?php
$siteTitle = 'メモ変更画面';
 require("head.php");
?>

<body class="page-login page-1colum">
  
    <style>
      .form .btn {
        float: none;
        margin: 30px 15px;
      }
    
      .form {
        text-align: center;
      }
    
      .form .btn-change {
        background: #5bbfea;
      }
    
      .form .btn-change:hover {
        background: #22A8E2;
      }
    </style>

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

          <!-- タイトル -->
          <label class="memo-title">タイトル</label>
          <input type="text" name="name">

          <!-- メモ内容 -->
          <label class="memo-contents">メモ</label>
          <textarea name="contents" id="memo-contents" cols="30" rows="10"></textarea>

          <!-- リスト -->
          <label class="memo-title">リスト名</label>
          <input type="text" name="list">

          <div class="btn-container">
            <input type="submit" class="btn btn-mid btn-change" value="変更する">
           </div>

          <label class="prev-a">
            <a href="memoContents.html">&lt;&lt;前のページに戻る</a>
          </label>
          
        </form>
      </div>

    </section>

  </div>

  <?php
 require('footer.php');
 ?>