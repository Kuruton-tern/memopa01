<?php
// 共通変数・関数ファイルを読み込み
require('function.php');

debug('                  ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　パスワード編集画面　」');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

// ログイン認証
require('auth.php');

//==============================
//画面処理
//==============================
// DBからユーザーデータを取得
$userData = getUser($_SESSION['user_id']);
debug('DBから取得したユーザーデータ：'.print_r($userData, true));
debug('DBから取得したユーザーパスワード：'.print_r($userData['password'], true));


if(!empty($_POST)){

  // 変数定義
  $pass_old = $_POST['pass_old'];
  $pass_new = $_POST['pass_new'];
  $pass_new_re = $_POST['pass_new_re'];


  // 未入力チェック
  validRequired($pass_old, "pass_old");
  validRequired($pass_new, "pass_new");
  validRequired($pass_new_re, "pass_new_re");

  // 未入力チェックでエラーなしの場合
  if(empty($err_msg)){
    debug('未入力チェックはOK');

    // パスワードの形式チェック
    validPass($pass_old, 'pass_old');
    validPass($pass_new, 'pass_new');
    validPass($pass_new_re, 'pass_new_re');
    debug('形式チェックOK');

    // 古いパスとDBのパスが異なっていたらエラーメッセージを出す
    if(!password_verify($pass_old, $userData['password'])){
      $err_msg['pass_old'] = MSG12;
      debug('入力パスワードとDBパスワードが異なります。');
    }
      // 入力した変更前パスワードと変更後パスが一緒だった場合エラーメッセージを出す
      if($pass_old === $pass_new){
        $err_msg['pass_new'] = MSG13;
        debug('古いパスと新しいパスが同じです。');
      }
        // 新しいパスと再入力パスが異なっていたらエラーメッセージを出す
        validMatch($pass_new, $pass_new_re, "pass_new_re");
          debug('新パスと再入力パスがマッチしていません。');


  // ここまでエラーメッセージがなければ、以下の処理へ
  if(empty($err_msg)){
    debug('バリデーションOK!!');
    // 例外処理
    try{
      // DB接続
      $dbh = dbConnect();
      // SQL作成
      $sql = 'UPDATE user SET password = :password WHERE id = :id';
      $data = array(':id' => $_SESSION['user_id'], ':password' => password_hash($pass_new, PASSWORD_DEFAULT));
      // クエリ実行
      $stmt = queryPost($dbh, $sql, $data);
      // クエリ成功の場合
      if($stmt){
        debug('クエリ成功');
        debug('画面を更新する');
        $_SESSION['msg_success'] = SUC02;

        // メールの送信先
        $to = $userData['email'];
        // タイトル：
        $title = 'パスワード変更通知｜memopa';
        // 相手：
        $username = $userData['username'];
        // 送信に使う自分のメールアドレス：
        $from = 'cherry.papapa.921.gmail';
        // 本文：
        $contents = <<<EOT
{$username}  さん

パスワードが変更されました。


///////////////////////////////////////
memopa
URL:  http://memopa.site
///////////////////////////////////////
EOT;

        sendEmail($to, $title, $contents, $username);
        debug('メールを送信しました。');
        debug('$contentsの中身：'.print_r($contents, true));
         header('Location:myMemo.php');
      }

    }catch(Exception $e){
       error_log('エラー発生：'. $e->getMessage());
       $err_msg['common'] = MSG07;
    }
  }
 }
}
debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');

?>


<?php
$siteTitle = 'パスワード変更画面';
 require("head.php");

?>

<body class="page-login page-1colum">

  <!-- ヘッダー  -->
<?php
require('header.php');
?>

  <!-- メインコンテンツ -->
  <div id="contents" class="site-width">

    <!-- Main -->
    <section id="main">
      <div class="form-container">
        <form action="" method="post" class="form">
          <h2 class="title">パスワード変更</h2>

          <div class="area-msg">
           <?php
            if(!empty($err_msg['common'])) echo $err_msg['common'];
            ?>
          </div>

          <!-- 旧パスワード -->
          <label class="">旧パスワード</label>
          <input type="password" name="pass_old">

          <div class="area-msg">
           <?php
            if(!empty($err_msg['pass_old'])) echo $err_msg['pass_old'];
            ?>
          </div>

          <!-- 新パスワード -->
          <label class="">新パスワード</label>
          <input type="password" name="pass_new">

          <div class="area-msg">
           <?php
            if(!empty($err_msg['pass_new'])) echo $err_msg['pass_new'];
            ?>
          </div>

          <!-- 新パスワード（再入力） -->
          <label class="">新パスワード（再入力）</label>
          <input type="password" name="pass_new_re">

          <div class="area-msg">
           <?php
            if(!empty($err_msg['pass_new_re'])) echo $err_msg['pass_new_re'];
            ?>
          </div>

          <div class="btn-container">
            <input type="submit" class="btn btn-mid" value="変更">
          </div>
        </form>
      </div>
    </section>

  </div>

  <?php
 require('footer.php');
?>
