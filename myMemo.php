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
// カテゴリー
$u_id = $_SESSION['user_id'];
// $category = getmemoCategory();
$memoData = getMemoData($u_id);

debug('$memoDataの中身：'.print_r($memoData, true));
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
    <!-- <?php
    // foreach($category as $key => $val);
     ?> -->
  <!-- メモの大枠1 -->
  <section class="list-wrap">
    <div class="list-panel">
      <!-- メモのヘッダー -->
      <div class="list-header">
        <h2 class="list-title"> <?php  ?></h2>
        <div class="list-header-icon">
          <i class="fas fa-trash-alt"></i>
          <a href="memoDetail.php"><i class="fas fa-edit"></i></a>
        </div>
      </div>
      <!-- メモの内容（タイトル部分） それの繰り返し -->
      <div class="memo-panel">
      html作成（メモタイトル）
      <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
      </div>
      </div>
      <div class="memo-panel">
      html作成（メモタイトル）
      <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
      </div>
      </div>
      <div class="memo-panel">
      html作成（メモタイトル）
      <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
      </div>
      </div>
      <div class="memo-panel">
      html作成（メモタイトル）ssssddddddddddddddddd
      <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
      </div>
      </div>
      <div class="memo-panel">
      html作成（メモタイトル）
      <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
      </div>
      </div>
      <div class="memo-panel">
      html作成（メモタイトル）
      <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
      </div>
      </div>
      <div class="memo-panel">
      html作成（メモタイトル）
      <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
      </div>
      </div>
      <div class="memo-panel">
      html作成（メモタイトル）
      <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
      </div>
      </div>
      <div class="memo-add">
        <span><a href="memoAdd.html"><i class="fas fa-pen-square"></i>さらにメモを追加する</a></span>
      </div>
     </div>
   </section>

 
  <!-- メモの大枠2 -->
  <section class="list-wrap">
    <div class="list-panel">
      <!-- メモのヘッダー -->
      <div class="list-header">
        <h2 class="list-title"> やること </h2>
        <div class="list-header-icon">
          <i class="fas fa-trash-alt"></i>
          <i class="fas fa-edit"></i>
        </div>
      </div>
      <!-- メモの内容（タイトル部分） それの繰り返し -->
      <div class="memo-panel">
      html作成（メモタイトル）
      <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
      </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
      testtesttestestestsetssetset作成（メモタイトル）aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        メモタイトル
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        php
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-add">
        <span><a href="memoAdd.html"><i class="fas fa-pen-square"></i>さらにメモを追加する</a></span>
      </div>
     </div>
   </section>

     <!-- メモの大枠3 -->
  <section class="list-wrap">
    <div class="list-panel">
      <!-- メモのヘッダー -->
      <div class="list-header">
        <h2 class="list-title"> やること </h2>
        <div class="list-header-icon">
          <i class="fas fa-trash-alt"></i>
          <i class="fas fa-edit"></i>
        </div>
      </div>
      <!-- メモの内容（タイトル部分） それの繰り返し -->
      <div class="memo-panel">
      html作成（メモタイトル）
      <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
      </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
      testtesttestestestsetssetset作成（メモタイトル）aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        メモタイトル
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        php
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-add">
        <span><a href="memoAdd.html"><i class="fas fa-pen-square"></i>さらにメモを追加する</a></span>
      </div>
     </div>
   </section>

<!-- メモの大枠4 -->
  <section class="list-wrap">
    <div class="list-panel">
      <!-- メモのヘッダー -->
      <div class="list-header">
        <h2 class="list-title"> やること </h2>
        <div class="list-header-icon">
          <i class="fas fa-trash-alt"></i>
          <i class="fas fa-edit"></i>
        </div>
      </div>
      <!-- メモの内容（タイトル部分） それの繰り返し -->
      <div class="memo-panel">
      html作成（メモタイトル）
      <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
      </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
      testtesttestestestsetssetset作成（メモタイトル）aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        メモタイトル
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        php
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-add">
        <span><a href="memoAdd.html"><i class="fas fa-pen-square"></i>さらにメモを追加する</a></span>
      </div>
     </div>
   </section>

   <!-- メモの大枠5 -->
  <section class="list-wrap">
    <div class="list-panel">
      <!-- メモのヘッダー -->
      <div class="list-header">
        <h2 class="list-title"> やること </h2>
        <div class="list-header-icon">
          <i class="fas fa-trash-alt"></i>
          <i class="fas fa-edit"></i>
        </div>
      </div>
      <!-- メモの内容（タイトル部分） それの繰り返し -->
      <div class="memo-panel">
      html作成（メモタイトル）
      <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
      </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
      testtesttestestestsetssetset作成（メモタイトル）aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        メモタイトル
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        php
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-add">
        <span><a href="memoAdd.html"><i class="fas fa-pen-square"></i>さらにメモを追加する</a></span>
      </div>
     </div>
   </section>

 <!-- メモの大枠6 -->
  <section class="list-wrap">
    <div class="list-panel">
      <!-- メモのヘッダー -->
      <div class="list-header">
        <h2 class="list-title"> やること </h2>
        <div class="list-header-icon">
          <i class="fas fa-trash-alt"></i>
          <i class="fas fa-edit"></i>
        </div>
      </div>
      <!-- メモの内容（タイトル部分） それの繰り返し -->
      <div class="memo-panel">
      html作成（メモタイトル）
      <div class="memo-panel-icon">
        <i class="fas fa-bars"></i>
      </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
      testtesttestestestsetssetset作成（メモタイトル）aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        メモタイトル
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        php
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-panel">
        html作成（メモタイトル）
        <div class="memo-panel-icon">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="memo-add">
        <span><a href="memoAdd.html"><i class="fas fa-pen-square"></i>さらにメモを追加する</a></span>
      </div>
     </div>
   </section>
   
  </div>
</div>

  <?php
 require('footer.php');
 ?>

