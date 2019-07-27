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

$u_id = $_SESSION['user_id'];
//商品IDのGETパラメータを取得
$memo_id = (!empty($_GET['m_id'])) ? $_GET['m_id'] : '';
// カテゴリーを取得
$category = getmemoCategory();
$memoData = getMemoData($u_id);

debug('$memoDataの中身：'.print_r($memoData, true));
debug('$categoryの中身：'.print_r($category, true))


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
     if(!empty($category)):
     foreach($category as $key => $val):
    //  debug('$valの中身：'.print_r($category, true));
?> 
  <!-- メモの大枠 -->
  <section class="list-wrap">
   
    <div class="list-panel">
      <!-- メモのヘッダー -->
      <div class="list-header">
        
        <h2 class="list-title"><?php echo sanitize($val['name']); ?></h2>
        <div class="list-header-icon">
          <i class="fas fa-trash-alt"></i>
          <a href="memoDetail.php?c_id=<?php echo sanitize($val['id']); ?>"><i class="fas fa-edit"></i></a>

        </div>
      </div>
      
      <!-- メモの内容（タイトル部分） それの繰り返し -->
      <?php
        foreach ($memoData as $key => $val) {
            if (!empty($val['name'])) {
                $memoTitle =  $val['name'];
      ?>
      <div class="memo-panel">
      <!-- GETパラメータを取れるように各メモのIDを呼び出す。 -->
     <!-- <a href="memoDetail.php?m_id=<?php echo sanitize($val['id']); ?>"><?php echo sanitize($val['name']); ?> -->
      <a href="memoDetail.php?c_id=<?php echo sanitize($val['category_id']); ?>?m_id=<?php echo sanitize($val['id']); ?>"><?php echo sanitize($val['name']); ?>
       <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
        </a>
       </div>
      </div>
     <?php
            }
        }
        ?>
      <div class="memo-add">
        <span><a href="memoDetail.php?c_id=<?php echo sanitize($val['id']); ?>"><i class="fas fa-pen-square"></i>さらにメモを追加する</a></span>
      </div>
     </div>
   
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

