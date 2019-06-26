<?php
$siteTitle = 'リスト作成';
 require("head.php");
?>


<body class="page-logined page-1colum">

    <style>
      .form .btn {
        float: none;
        margin: 30px 15px;
      }
    
      .form {
        text-align: center;
      }
    
      .form .btn-create {
        background: #1CAE35;
      }
    
      .form .btn-create:hover {
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
    <section id="main" class="list">
      <div class="form-container">
        <form action="" method="post" class="form">

          <!-- リスト -->
          <label class="memo-title">リスト名</label>
          <input type="text" name="name">

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