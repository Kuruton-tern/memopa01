<?php
 require('function.php');
 
  debug('                  ');
  debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
  debug('「　トップ画面　」');
  debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
  debugLogStart();


  // $info = dns_get_record('memopa.site', DNS_A);
  // echo $info;
  // debug('memopa.siteのDSN情報：'.print_r($info, true));
?>


<?php
$siteTitle = 'memopaトップ';
require("head.php");

?>

  <body class="page-logout page-1colum">
  
    <!-- ヘッダー  -->
<?php
require('header.php');
?>  

  <div class="t-text-box">
    <h1 class="t-text-title">memopaへようこそ！</h1>
    <p>
      どんなにくだらないことでもメモをパッと取っておきましょう。<br>
      あなたの生活、ビジネス、恋愛の恩人になるかもしれない言葉をリストで保存。<br>
      todoリストとしても使えます。<br>
    </p>
   <!-- ログイン・新規登録ボタン設置 -->
   <div class="btn-container">
           <a href="login.php"><button class="btn-entry btn-log">ログイン</button></a>
           <a href="signup.php"><button class="btn-entry btn-signup">新規会員登録</button></a>
   </div>

  </div>

     <!-- メインコンテンツ -->
    <div id="main" class="page-top">
      <!-- メモの大枠 -->
      <div class="list-wrap">
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
             memopaをご覧いただき、ありがとうございます。
            <div class="memo-panel-icon">
              <i class="fas fa-bars"></i>
            </div>
          </div>
          <div class="memo-panel">
            このmemopaがアウトプットとして初めて作ったものになります。
            <div class="memo-panel-icon">
              <i class="fas fa-bars"></i>
            </div>
          </div>
          <div class="memo-panel">
           自分で投稿したメモのタイトルが、カテゴリごとに並んだとき、ガッツポーズをしました。
            <div class="memo-panel-icon">
              <i class="fas fa-bars"></i>
            </div>
          </div>
          <div class="memo-panel">
          苦しい気持ちが９割、楽しい気持ちが１割でしたがこの１割のために続けられました。
            <div class="memo-panel-icon">
              <i class="fas fa-bars"></i>
            </div>
          </div>
          <div class="memo-panel">
            自分一人では諦めていたかも知れません。
            <div class="memo-panel-icon">
              <i class="fas fa-bars"></i>
            </div>
          </div>
          <div class="memo-panel">
            教えてくださる方、励ましてくださる方のおかげで苦しい！わかんない！という状況を乗り越えられました。
            <div class="memo-panel-icon">
              <i class="fas fa-bars"></i>
            </div>
          </div>
          <div class="memo-panel">
           本当にありがとうございます。
            <div class="memo-panel-icon">
              <i class="fas fa-bars"></i>
            </div>
          </div>
          <div class="memo-panel">
           自分への助言：確認を怠るな！！
            <div class="memo-panel-icon">
              <i class="fas fa-bars"></i>
            </div>
          </div>
          <div class="memo-add">
            <span><a href="memoAdd.html"><i class="fas fa-pen-square"></i>さらにメモを追加する</a></span>
          </div>
        </div>
      </div>
  
      <!-- メモの大枠 -->
      <div class="list-wrap">
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
           fdsff
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
      </div>
  
      <!-- メモの大枠 -->
      <div class="list-wrap">
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
           fdsff
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
            gkjfjkghkfgfhaksldjghs
            fdlgfdkgsdl;gjlasjf
            fdgsdflgj;sjg';sjlsa'
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
      </div>
    
    <!-- メモの大枠 -->
    <div class="list-wrap">
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
          asdfdfdfddgskgkfjdslkkghksdhflaks
          ffffgfdg
          dfgdfgfdsgdsfg
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
          dfsfs
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
    </div>

      <!-- メモの大枠 -->
      <div class="list-wrap">
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
      </div>
  
        
     </div>
  </div>
  
<?php
 require('footer.php');
?>