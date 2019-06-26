
<?php
require('function.php');

debug('                  ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　退会画面　」');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');


//==============================
//画面処理
//==============================
// POST送信の有無のチェック
if(!empty($_POST)){
  debug('POST送信があります');
  try{
    // DBに接続
    $dbh = dbConnect();
    // SQL文作成
    $sql = 'UPDATE memo SET delete_flg = 1 WHERE id = :user_id';
    $data = array(:user_id => );
    
  }
}

?>

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

  <?php
    require('header.php');
   ?>

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