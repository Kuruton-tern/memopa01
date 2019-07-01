<?php 
// 共通変数・関数ファイルを読み込み
require('function.php');

debug('                  ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　プロフ編集画面　」');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

// ログイン認証
require('auth.php');

//==============================
//画面処理
//==============================
// DBからユーザーデータを取得
// DBから取得したユーザーデータ
$dbFormData = getUser($_SESSION['user_id']);
debug('DBから取得したユーザーデータ：'.print_r($dbFormData, true));

if (!empty($_POST)) {
  debug('POST送信があります');
  debug('POST情報：' . print_r($_POST, true));
  debug('FILE情報：'. print_r($_FILES, true));

<<<<<<< Updated upstream
//画面表示用データを変数に格納
<<<<<<< Updated upstream
//==============================
// DBからユーザーデータを取得
$dbFormData = getUser($_SESSION['user_id']);
debug('DBから取得したユーザーデータ：'.print_r($dbFormData, true));
$u_id = $_SESSION['user_id'];
$username = $_POST['username'];
$email = $_POST['email'];
$pic = ;
=======
    //==============================
    // DBからユーザーデータを取得
    // DBから取得したユーザーデータ
    $dbFormData = getUser($_SESSION['user_id']);
    debug('DBから取得したユーザーデータ：'.print_r($dbFormData, true));
    // ユーザーID
=======
  // 変数にユーザー情報を代入
  // ユーザーID
>>>>>>> Stashed changes
    $u_id = $_SESSION['user_id'];
    // ユーザー名
    $username = $_POST['username'];
    // メールアドレス
    $email = $_POST['email'];

    //画像をアップロードし、パスを格納
    $pic = (!empty($_FILES['pic']['name'])) ? uploadImgOri($_FILES['pic'], 'pic') : '';
    //画像をPOSTしてない（登録していない）がすでにDBに登録されている場合、DBのパスを入れる（POSTには反映されないため）
    $pic = (empty($pic) && !empty($dbFormData['pic'])) ? $dbFormData['pic'] : $pic;
    debug('$picの内容：'.print_r($pic, true));


<<<<<<< Updated upstream
    // DB情報($dbFormData)と入力した情報($_POST)が違う場合にバリデーションを行う
    // ユーザー名チェック
    if ($dbFormData['username'] !== $_POST['username']) {
      // 名前の長さのバリデーションチェック
=======

      // DB情報($dbFormData)と入力した情報($_POST)が違う場合にバリデーションを行う
      // ユーザー名チェック
      if($dbFormData['username'] !== $username){
      // 名前の最大文字数チェック
>>>>>>> Stashed changes
      validUnameMax($username, 'username');

      debug('ユーザー名が新たに入力されました');
    }
    // メールアドレスチェック
    if ($dbFormData['email'] !== $email) {
      // 最大文字数チェック
      validLenMax($email, 'email');

      if (empty($err_msg['email'])) {
        // email重複チェック
        validEmailDup($email);
      }
      // emailの形式チェック
      validEMail($email, 'email');
      // 未入力チェック
      validRequired($email, 'email');
      debug('emailが新たに入力されました');
    }

    if (empty($err_msg)) {
      debug('バリデーションチェックOKです');
      // 例外処理
        try {
            // DB接続
            $dbh = dbConnect();
            // SQL文作成
            // 新しく入力した情報をDBに登録する
            $sql = 'UPDATE user SET username = :username, email = :email WHERE id = :u_id';
            $data = array(':username' => $username, ':email' => $email, ':u_id' => $dbFormData['id']);
            // クエリ実行
            $stmt = queryPost($dbh, $sql, $data);

            // クエリ成功の場合
            if ($stmt) {
                debug('画面を更新する');
                $_SESSION['msg_success'] = SUK02;
            }
        } catch (Exeption $e) {
            error_log('エラー発生：'.$e->getMessage());
            $err_msg['common'] = MSG07;
        }
    }
}
debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');

<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
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
        
        <form action="" method="post" class="form">
          <div class="area-msg">
            <?php
            if(!empty($err_msg['common'])){
              echo $err_msg['common'];
            }
            ?>
          </div>
          <!-- アバター写真 -->
          <div class="prof-img">
<<<<<<< Updated upstream
           <img src="img/me01.png" alt="">
=======
          <input type="hidden" name="MAX-FILE-SIZE" value="3145728">
          <input type="file" name="pic" class="input-file">
           <img src="img/me01.png" alt="アバター写真">
>>>>>>> Stashed changes
          </div>
          
          <!-- ユーザー名 -->
          <label class="">ユーザー名</label>
            <input type="text" name="username" id="" value="<?php echo getFormData('username'); ?>">
            <div class="area-msg">
              <?php 
                if(!empty($err_msg['username'])) echo $err_msg['username'];
                ?>
            </div>
            <!-- メールアドレス -->
            <label class="">メールアドレス</label>
              <input type="text" name="email" id="" value="<?php echo getFormData('email'); ?>">
              <div class="area-msg">
                <?php 
                  if(!empty($err_msg['email'])) echo $err_msg['email'];
                  ?>
               </div>
              <div class="btn-container">
                <input type="submit" class="btn btn-mid" value="変更">
              </div>
              
          </form>
      </div>
    </section>
    
    <!-- サイドバー -->
    <section class="sidebar">
      <a href="myMemo.php">マイメモ</a>
      <a href="memoContents.php">メモを投稿する</a>
      <a href="myProf.php">プロフィール編集</a>
      <a href="passEdit.php">パスワード変更</a>
      <a href="withdraw.php">退会</a>
    </section> 

  </div>
  
  <?php
 require('footer.php');
?>