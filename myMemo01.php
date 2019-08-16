<!-- 方法①メモのカテゴリの取得を、カテゴリごとに行う方法 -->

<?php
require('function.php');

debug('                  ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　マイメモ画面　」');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();


// ログイン認証
require('auth.php');

if (empty($_SESSION['login_date'])) {
    header('Location:index.php');
    debug('SESSIONがなかったためトップ画面に遷移します');
}

//==============================
//画面処理
//==============================
//画面表示用データ取得
//==============================
// GETパラメータを取得
//------------------------------
//商品IDのGETパラメータを取得
$memo_id = (!empty($_GET['m_id'])) ? $_GET['m_id'] : '';

$u_id = $_SESSION['user_id'];

// DBからcategoryテーブルの中身を取得
$category = getCategory();

// DBからmemoテーブルの中身を取得
$memoData = getMemoData($u_id);

debug('$categoryの中身：'.print_r($category, true));
// debug('$memoDataの中身：'.print_r($memoData, true));


?>



<?php
$siteTitle = 'マイメモ';
 require("head.php");

?>

<body class="page-logined page-1colum">

  <!-- ヘッダー  -->
  <?php
require('header.php');
?>

<p id="js-show-msg" class="msg-slide" style="display:none;">
<?php
echo getSessionFlash('msg_success');
debug('サクセスメッセージを出しました');
?>
</p>


  <!-- メインコンテンツ -->
 <div id="mymemo-main">

 
  <div id="page-panel">
     <?php
     if (!empty($category)):
      // 全カテゴリーをループで回す
     foreach ($category as $val):
    //  debug('$valの中身：'.print_r($category, true));

    // カテゴリのIDを取得
    $category_id = $val['id'];
    debug('$category_idの中身：'.print_r($category_id, true));
    
      // DBからユーザーIDとカテゴリーIDをもとにメモの情報を取得
      $memos = getMyMemo($category_id, $u_id);
      debug('$memosの中身'.print_r($memos, true));

      if (!empty($memos)) {
          ?>

  <!-- メモの大枠 -->
  <section class="list-wrap">
   
    <div class="list-panel">
      <!-- メモのヘッダー -->
      <div class="list-header">
        <!-- カテゴリ名を出力（PHP） -->
        <h2 class="list-title"><?php echo sanitize($val['name']); ?></h2>
        <div class="list-header-icon">
          <i class="fas fa-trash-alt"></i>
          <a href="memoDetail.php?c_id=<?php echo sanitize($val['id']); ?>"><i class="fas fa-edit"></i></a>

        </div>
      </div>
          <?php
          foreach ($memos as $memo) {
              ?>
      <!-- メモの内容（タイトル部分） それの繰り返し -->
      <div class="memo-panel">
          <?php
          echo sanitize($memo['name']); ?>
      <!-- GETパラメータを取れるように各メモのIDを呼び出す。 -->
     
      <a href="memoDetail.php?c_id=<?php ?>?m_id=<?php echo sanitize($memo['id']); ?>">
      
       <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
        </a>
       </div>
      </div>
     <?php
           ?>

      <div class="memo-add">
        <span><a href="memoDetail.php?c_id=<?php echo sanitize($val['id']); ?>"><i class="fas fa-pen-square"></i>さらにメモを追加する</a></span>
      </div>
     </div>
    <?php
          } ?>
   </section>

<?php
      }
  endforeach;
  endif;
      ?>
  </div>
</div>

  <?php
 require('footer.php');
 ?>

