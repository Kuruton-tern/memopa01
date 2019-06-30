<?php 
require('function.php');

debug('                  ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　アカウント作成画面　」');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

// ログイン認証
require('auth.php');

//==============================
//画面処理
//==============================


//画面表示用データを変数に格納
//==============================
// DBからユーザーデータを取得
$dbFormData = getUser($_SESSION['user_id']);
debug('DBから取得したユーザーデータ：'.print_r($dbFormData, true));
$u_id = $_SESSION['user_id'];
$username = $_POST['username'];
$email = $_POST['email'];
$pic = ;
?>

<?php
$siteTitle = 'マイプロフ';
 require("head.php");

?>

<body class="page-logined page-2colum page-profEdit">

  <!-- ヘッダー  -->
<?php 
require('header.php');
?>

  <!-- メインコンテンツ -->
  <div id="contents" class="site-width">
    
    <!-- main -->
    <section id="main" class="prof">
      <div class="form-container prof-form">
        <h2 class="title">アカウント情報</h2>
        
        <form action="" class="form">
          <div class="area-msg">
            ユーザー名は日本語のみ使用できます。
            メールアドレスが適切ではありません。
          </div>
          <!-- アバター写真 -->
          <div class="prof-img">
           <img src="img/me01.png" alt="">
          </div>
          
          <!-- ユーザー名 -->
          <label class="">ユーザー名</label>
            <input type="text" name="username" id="">
            
            <!-- メールアドレス -->
            <label class="">メールアドレス</label>
              <input type="text" name="email" id="">
              
              <div class="btn-container">
                <input type="submit" class="btn btn-mid" value="変更">
              </div>
              
          </form>
      </div>
    </section>
    
    <!-- サイドバー -->
    <section class="sidebar">
      
      <a href="memoContents.php">メモを投稿する</a>
      <a href="myProf.php">プロフィール編集</a>
      <a href="passEdit.php">パスワード変更</a>
      <a href="withdraw.php">退会</a>
    </section> 

  </div>
  
  <?php
 require('footer.php');
?>