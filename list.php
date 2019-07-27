<?php
// 共通変数・関数ファイルを読み込み
require('function.php');

debug('                  ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　リスト作成画面　」');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

// ログイン認証
require('auth.php');

//==============================
//画面処理
//==============================
// ユーザーごとにリストを作成していく
$u_id = $_SESSION['user_id'];

// POST送信のチェック
if(!empty($_POST)){
  debug('POST送信があります');
  debug('POST内容情報：'.print_r($_POST, true));

  $category = $_POST['category'];

  // 未入力チェック
  validRequired($category, 'category');
  
  if(empty($err_msg)){
    debug('未入力チェックOK');
    // 最大文字数チェック
    validLenMax($category, 'category');
    // リスト名重複チェック
    validListDup($category);
    debug('最大文字数、リスト重複チェック完了');

    if (empty($err_msg)) {
        debug('バリデーションチェックOK');
        try {
            // 例外処理
            $dbh = dbConnect();
            // SQL文作成
            $sql = 'INSERT INTO category (name, user_id, create_date) VALUE(:name, :u_id, :create_date)';
            $data = array(':name' => $category, ':u_id' => $_SESSION['user_id'], ':create_date' => date('Y-m-d H:i:s'));
            // クエリ実行
            debug('SQLの中身：'.print_r($sql, true));
            debug('流し込みデータ：'.print_r($data, true));

            $stmt = queryPost($dbh, $sql, $data);

            // クエリ成功の場合
            if ($stmt) {
                $_SESSION['msg_success'] = SUC06;
                header("Location:myMemo.php");
            }
        } catch (Exception $e) {
            error_log("エラー発生：".$e-getMessage());
            $err_msg['common'] = MSG07;
      }
    }
  }
}
debug('画面表示処理終了<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');


?>



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

            <div class="area-msg">
              <?php echo getErr_msg('common'); ?>
            </div>

          <!-- リスト -->
          <label class="memo-title">リスト名
            <input type="text" name="category">
          </label>

            <div class="area-msg">
              <?php echo getErr_msg('category'); ?>
            </div>

          <div class="btn-container">
            <input type="submit" class="open btn btn-mid btn-create" value="作成">
          </div>
        </form>
      </div>

  </div>
    </section>



  <?php
 require('footer.php');
 ?>