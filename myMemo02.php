<!-- 方法② メモのカテゴリをカテゴリループ内で、メモ内のカテゴリIDを比較、出力する -->

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
    header('Location:top.php');
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
$memos = getMemoData($u_id);

debug('$categoryの中身：'.print_r($category, true));
// debug('$memosの中身：'.print_r($memos, true));


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
    // debug('$category_idの中身：'.print_r($category_id, true));
    // メモ表示用の配列を用意
    $display_memos = array();

          // メモを全件回して、現在のカテゴリIDのメモ情報を”display_memos”に格納する
          foreach ($memos as $memo) {
              // 現在のカテゴリIDとメモのカテゴリIDを比較して、一致するものを出力する
              if ($category_id === $memo['category_id']) {
                  $display_memos[] = $memo;
                  debug('$display_memosの中身：'.print_r($display_memos, true));
              }
          }
          // if (count($display_memos) > 0) {
            if (!empty($display_memos)) {
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
          foreach ($display_memos as $key => $memos_val) {
              ?>
      <!-- メモの内容（タイトル部分） それの繰り返し -->
      <div class="memo-panel">
          <?php
          echo($memos_val['name']); ?>
      <!-- GETパラメータを取れるように各メモのIDを呼び出す。 -->
     
      <a href="memoDetail.php?c_id=<?php ?>?m_id=<?php echo sanitize($memo['id']); ?>">
      
       <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
        </a>
       </div>
      </div>
     <?php
          } ?>

      <div class="memo-add">
        <span><a href="memoDetail.php?c_id=<?php echo sanitize($val['id']); ?>"><i class="fas fa-pen-square"></i>さらにメモを追加する</a></span>
      </div>
     </div>
    <?php
            }

           ?>
   </section>

<?php
  endforeach;
  endif;
      ?>
  </div>
</div>

  <?php
 require('footer.php');
 ?>

