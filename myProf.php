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
// DBから取得したユーザーデータ
$dbFormData = getUser($_SESSION['user_id']);
  debug('DBから取得したユーザーデータ：'.print_r($dbFormData, true));
// ユーザーID
$u_id = $_SESSION['user_id'];
// ユーザー名
$username = $_POST['username'];
// メールアドレス
$email = $_POST['email'];

//画像をアップロードし、パスを格納
$pic = (!empty($_FILES['pic']['name'])) ? uploadImg($_FILES['pic'], 'pic') : '';
//画像をPOSTしてない（登録していない）がすでにDBに登録されている場合、DBのパスを入れる（POSTには反映されないため）
$pic = (empty($pic) && !empty($dbFormData['pic'])) ? $dbFormData['pic'] : $pic;
  debug('$picの内容：'.print_r($pic, true));


  // DB情報($dbFormData)と入力した情報($_POST)が違う場合にバリデーションを行う
  // ユーザー名チェック
  if($dbFormData['username'] !== $_POST['username']){
    debug('ユーザー名が新たに入力されました');
      // 名前の長さのバリデーションチェック
      validUnameMax($username, 'username');
      // 名前の未入力チェック
      validRequired($username, 'username');
  }
  // メールアドレスチェック
  if($dbFormData['email'] !== $_POST['email']){
    debug('emailが新たに入力されました');
    if(empty($err_msg['email'])){
      validEmailDup($email);
    }
    // emailの形式チェック
    validEMail($email, 'email');
    // 最大文字数チェック
    validMaxLen($mail, 'email');
    // 未入力チェック
    validRequired($email, 'email');
  }
  if(empty($err_msg)){
    debug('バリデーションチェックOKです');
    try{
      // DB接続
      $dbh = dbConnect();
      // SQL文作成
      // 新しく入力した情報をDBに登録する
      $sql = 'UPDATE user SET username = :username, email = :email WHERE id = :u_id';
      $data = array(':username' => $username, ':email' => $email);
      $stmt = queryPost($dbh, $sql, $data);

      if($stmt){
        debug('画面を更新する');
      }
      }catch(Exeption $e){
        error_log('エラー発生：'.$e->getMessage());
        $err_msg['common'] = MSG07;
      }
  }


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
          <input type="hidden" name="MAX-FILE-SIZE" value="3145728">
          <input type="file" name="pic" class="input-file" style="height:370px;">
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