<?php
$siteTitle = 'メモ作成ページ';
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
    .form .btn-create{
      background: #1CAE35;
    }
    .form .btn-create:hover{
        background: #32cd32;
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
          <textarea name="contents" id="memo-area" cols="30" rows="30"></textarea>
          
          <div class="btn-container">
            <input type="submit" class="btn btn-mid btn-create" value="作成">
          </div>
        </form>
      </div>
    </section>

  </div>

 <?php
 require('footer.php');
 ?>