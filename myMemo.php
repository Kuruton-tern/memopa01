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
// ユーザーIDをセッションから取得
$u_id = $_SESSION['user_id'];

// DBからcategoryテーブルの中身を取得
$categories = getCategory();
// DBからユーザーIDが当てはまるmemoテーブルの中身を取得
$memos = getMemoData($u_id);
debug('$categoriesの中身：'.print_r($categories, true));
debug('$memosの中身：'.print_r($memos, true));
$display_memos = array();

// カテゴリーを全件回す
foreach ($categories as $category) {
    // メモのカテゴリーIDをキーに、連想配列へ格納する
    if ($category['user_id'] === $u_id) {
        $display_memos[$category['id']]['category'] = $category;
    }
}

// メモを全件回す
foreach($memos as $memo){
  // メモのカテゴリーIDをキーに、連想配列へ格納する
  $display_memos[$memo['category_id']]['memo'][] = $memo;
  $display_memos_memo = $display_memos[$memo['category_id']]['memo'];
  debug('$display_memos_memoの中身：'.print_r($display_memos_memo, true));
}

debug('display_memosの中身：'.print_r($display_memos, true));

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
    //  画面描画用の連想配列でループを回す
    foreach ($display_memos as $category_id => $display_memo) {
      debug('$display_memoの中身：'.print_r($display_memo, true));
        
      // 現在のカテゴリ情報とメモリストを取得する
        $category = $display_memo['category'];
       
        // もし$display_memo['memo']があれば$memo_by_categoryに格納する（下のif文を入れると未メモ有カテゴリに最新メモが入ってしまう）
        // if (!empty($display_memo['memo'])) {
            $memos_by_category = $display_memo['memo'];
        //  }
        debug('$memos_by_categoryの中身：'.print_r($memos_by_category, true));
        
        ?>
   

  <!-- メモの大枠 -->
    
  <section class="list-wrap">
   
    <div class="list-panel">
      <!-- メモのヘッダー -->
      <div class="list-header">
        <!-- カテゴリ名を出力（PHP） -->
        <h2 class="list-title"><?php echo sanitize($category['name']); ?></h2>
        <div class="list-header-icon">
          <i class="fas fa-trash-alt"></i>
          <a href="memoDetail.php?c_id=<?php echo sanitize($category['id']); ?>"><i class="fas fa-edit"></i></a>
        </div>
      </div>
          
          <?php
          foreach ($memos_by_category as $memo_by_category) {
              ?>
      <!-- メモの内容（タイトル部分） それの繰り返し -->
      <div class="memo-panel">
        <?php
       
          echo($memo_by_category['name']); ?>
      <!-- GETパラメータを取れるように各メモのIDを呼び出す。 -->
      <a href="memoDetail.php?m_id=<?php echo sanitize($memo_by_category['id']); ?>">
       <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
        </a>
       </div>
      </div>
    <?php
       }
    ?>

      <div class="memo-add">
        <span><a href="memoDetail.php?c_id=<?php echo sanitize($category['id']); ?>"><i class="fas fa-pen-square"></i>さらにメモを追加する</a></span>
      </div>
     </div>
    
   </section>
  <?php
  }
 ?>

  </div>
</div>


  <?php
 require('footer.php');
 ?>

