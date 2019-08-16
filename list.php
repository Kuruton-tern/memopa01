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


              foreach ((array)$dbFormData as $key => $val) {
                  if ($c_id == $val['id']) {
                      echo $val['name'];
                      debug('idの中身：'.print_r($val['id'], true));
                      debug('nameの中身：'.print_r($val['name'], true));
                  }
              }



//==============================
//画面処理
//==============================
// c-idが空なら空文字を入れる
$c_id = (!empty($_GET['c_id'])) ? $_GET['c_id'] : '';

// ユーザーごとにリストを作成していく
$u_id = $_SESSION['user_id'];

// DBよりメモのカテゴリーデータを取得する。カテゴリーデータがなければ空文字を入れる。
$dbFormData = (!empty($c_id)) ? getMemoCategory($u_id) : '';
// 新規メモ作成画面か、編集画面か判別する
// 新規作成ならfalse, 編集ならtrue
$edit_flg = (empty($dbFormData)) ? false : true;

debug('$dbFormDataの中身：'.print_r($dbFormData, true));
debug('$edit_flgの中身：'.print_r($edit_flg, true));

// パラメータ改ざんチェック
//==============================
//GETパラメータはあるが、改ざんされている（URLをいじくった）場合、正しいメモデータが取れないのでマイプロフへ遷移させる
// if(!empty($m_id) && empty($dbFormData)){
//   debug('GETパラメータの商品IDは違います。マイプロフへ遷移します');
//   header("Location:")
// }

// POST送信時処理チェック
//==============================
// POST送信のチェック
if(!empty($_POST)){
  debug('POST送信があります');
  debug('POST内容情報：'.print_r($_POST, true));

  // 変数に入力情報を代入
  $category = $_POST['category'];

  // 新規登録だったら（カテゴリーデータがなければ）
  if (empty($dbFormData)) {
      // 未入力チェック
      validRequired($category, 'category');
  }else{
    // 更新であれば以下の処理から
      if (empty($err_msg)) {
          debug('未入力チェックOK');
          // 最大文字数チェック
          validLenMax($category, 'category');
          // リスト名重複チェック
          validListDup($category);
          debug('最大文字数、リスト重複チェック完了');
      }
  }
    if (empty($err_msg)) {
        debug('バリデーションチェックOK');
        // 例外処理
        try {
            // DB接続
            $dbh = dbConnect();

            // SQL文作成
            // カテゴリー編集なら
            if ($edit_flg) {
              debug('カテゴリー編集なのでDBアップデートです。');
                $sql = 'UPDATE category SET name = :name, update_date = :update_date WHERE user_id = :u_id AND id = :c_id';
                $data = array(':name' => $category, ':update_date' => date('Y-m-d H:i:s'), ':u_id' => $_SESSION['user_id'], ':c_id' => $c_id);
                // クエリ実行
                debug('SQLの中身：'.print_r($sql, true));
                debug('流し込みデータ：'.print_r($data, true));

                $stmt = queryPost($dbh, $sql, $data);

                // クエリ成功の場合
                if ($stmt) {
                    $_SESSION['msg_success'] = SUC06;
                    header("Location:myMemo.php");
                }
            }else{
              // カテゴリー新規作成なら
              debug('カテゴリー新規作成なのでDB登録です。');
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
            }
        } catch (Exception $e) {
            error_log("エラー発生：".$e-getMessage());
            $err_msg['common'] = MSG07;
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
            <input type="text" name="category" value="<?php
              foreach ((array)$dbFormData as $key => $val) {
                  if (!empty($dbFormData)) {
                      if ($c_id == $val['id']) {
                          echo $val['name'];
                          debug('idの中身：'.print_r($val['id'], true));
                          debug('nameの中身：'.print_r($val['name'], true));
                      }
                  }else{
                    echo '';
                  }
              }
              ?>">
            
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