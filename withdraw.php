
<?php
require('function.php');

debug('                  ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　退会画面　」');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');

// ログイン認証
require('auth.php');

//==============================
//画面処理
//==============================
// POST送信の有無のチェック
if(!empty($_POST)){
  debug('POST送信があります');
  // 例外処理
  try{
    // DBに接続
    $dbh = dbConnect();
    // SQL文作成
    $sql1 = 'UPDATE memo SET delete_flg = 1 WHERE id = :user_id';
    $sql2 = 'UPDATE user SET delete_flg = 1 WHERE id = :user_id';

    $data = array(':user_id' => $_SESSION['user_id']);
    $stmt1 = queryPost($dbh, $sql1, $data);
    $stmt2 = queryPost($dbh, $sql2, $data);
    // クエリ実行成功の場合
    if($stmt2){
      debug('退会処理のためセッションを破壊します');
      // セッションを壊す
      $_SESSION = array();
      session_destroy();
      // 本当に消せたか確認
      debug('$_SESSIONの確認：'.print_r($_SESSION, true));
      // トップページへ遷移
      header('Location:index.php');
    }else{
      debug('クエリ失敗しました');
      $err_msg = MSG07;
    }
  }catch(Exception $e){
    error_log("エラー発生：".$e->getMessage());
    debug('SQL実行失敗しました');
    $err_msg['common'] = MSG07;
  }
}
debug('画面表示処理終了<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');


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
            <?php
            if(!empty($err_msg['common'])) echo $err_msg['common'];
            ?>
          </div>

          <div class="area-msg">
            下の「退会」ボタンを押すと二度と情報の復元はできません。
            よろしいですか？
          </div>
        <!-- 退会ボタン -->
          <div class="btn-container">
            <input type="submit" class="btn btn-mid" name="submit" value="退会">
          </div>
        
        </form>
      </div>
    </section>

  </div>

  
<?php 
 require('footer.php');
 ?> 