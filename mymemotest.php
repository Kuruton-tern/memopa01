<?php
require('function.php');

debug('                  ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　マイメモ画面　」');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();


// ログイン認証
require('auth.php');

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

  <!-- メインコンテンツ -->
 <div id="mymemo-main">

 
  <div id="page-panel">
  <!-- メモの大枠 -->
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

  <!-- メモの大枠 -->
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
  
  <!-- メモの大枠 -->
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
  
  <!-- メモの大枠 -->
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
    
  <!-- メモの大枠 -->
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

  <!-- メモの大枠 -->
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

  <!-- メモの大枠 -->
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