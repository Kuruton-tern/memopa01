<?php
// 共有変数・関数ファイルを読み込み
require('function.php');

debug('                  ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　パスワード再発行認証キー入力ページ　」');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

// セッションに認証キーがついているか確認、なければ再発行ページへ
if(empty($_SESSION['auth_key'])){
  debug('セッションに認証キーがついていません。画面を遷移します。');
  header("Location:passRemindSend.php");
}

//==============================
// 画面処理
//==============================
// POST送信があったかチェック
if (!empty($_POST)) {
    debug('ポスト送信があります。');
    debug('ポスト情報：'.print_r($_POST, true));

    
    // 変数定義
    $auth_key = $_POST['token'];

    // 未入力チェック
    validRequired($auth_key, 'token');

    if (empty($err_msg)) {
        debug('未入力チェックOK。');

        //固定長チェック
        validLength($auth_key, 'token');
        //半角チェック
        validHalfAZ09($auth_key, 'token');

        if (empty($err_msg)) {
            debug('バリデーションOK。');
  
            // 入力された認証キーとセッションの認証キーが合っているかチェック
            //$auth_keyはこの画面で入力されたやつ。$_SESSION['auth_key']はセッションに保存されている内容。同じブラウザからじゃないとだめだよってこと。
            if ($auth_key !== $_SESSION['auth_key']) {
                $err_msg['common'] = MSG15;
            }

            // 現在時刻と認証キーの有効期限の時間を比較
            if (time() > $_SESSION['auth_limit']) {
                $err_msg["common"] = MSG16;
                debug('セッションの有効期限が切れています。画面遷移します。');
                header('Location:passRemindSend.pjp');
            }
            if (empty($err_msg)) {
                debug('認証OK。');
                // 有効期限内ならば新しいパスをランダムで作る（期限を超えていたらエラーメッセ＆再発行メール画面に遷移）
                $pass_rand = makeRandkey();
                debug('再発行パスワード：'.print_r($pass_rand, true));

                try{
                  // DB接続
                  $dbh = dbConnect();
                  // SQL文作成
                  // emailはセッションに入ってる
                  $sql = 'UPDATE user SET password = :pass_rand WHERE email = :email AND delete_flg = 0';
                  $data = array(':pass_rand' => password_hash($pass_rand, PASSWORD_BCRYPT), ':email' => $_SESSION['auth_email']);
                  // クエリ実行
                  $stmt = queryPost($dbh, $sql, $data);

                 if($stmt){
                   debug('クエリ成功');
                   $_SESSION['msg_success'] = SUC04;

                   // メール送信
                    // メールの送信先
                    $to = $_SESSION['auth_email'];
                    // タイトル：
                    $title = 'パスワード再発行　認証メール｜memopa';
                    // 相手：(メールアドレス)
                    $username = $_SESSION['auth_email'];
                    // 送信に使う自分のメールアドレス：
                    $from = 'cherry.papapa.921.gmail';
                    // 本文：
                    $contents = <<<EOT
{$username}  さん

本メールアドレス宛にパスワードの再発行を致しました。
下記のURLより新パスワードを使いログインください。


パスワード再発行認証キー入力ページ：http://localhost:8888/memopa/login.php
新パスワード：{$pass_rand}

※ログイン後、パスワードの変更をよろしくお願い致します。


///////////////////////////////////////
memopa
URL:  http://memopa.com
Email: kuruton@gmail.com
///////////////////////////////////////
EOT;

        sendEmail($to, $title, $contents, $username);
        debug('$contentsの中身：'.print_r($contents, true));
        debug('$_SESSIONの中身：'.print_r($_SESSION, true));
        
        //  セッションを削除
        session_unset();
        debug('$_SESSIONの中身：'.print_r($_SESSION, true));
        header("Location:login.php");
                 }else{
                   debug('クエリに失敗しました。');
                   $err_msg['common'] = MSG07;
                 }
  
                }catch(Exception $e){
                  error_log('エラー発生：'.$e->getMessage());
                  $err_msg['common'] = MSG07;
                }
            }
        }
    }
}

?>

<?php
$siteTitle = 'パスワード認証画面';
 require("head.php");
?>

<body class="page-login page-1colum">

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
  <div id="contents" class="site-width">

    <!-- Main -->
    <section id="main">
      <div class="form-container">
        <form action="" method="post" class="form">
          <h2 class="title">認証ページ</h2>
          <div class="pass-text">
            <p>ご指定のメールアドレスお送りした【パスワード再発行認証メール】内にある「認証キー」をご入力ください。</p>
          </div>

          <div class="area-msg">
            <?php
            if(!empty($err_msg['common'])) echo $err_msg['common'];
            ?>
          </div>
          <!-- 認証キー -->
          <label class="<?php if(!empty($err_msg['token'])) echo 'err'; ?>">認証キー
          <input type="text" name="token">
          </label>
          <div class="area-msg">
              <?php if (!empty($err_msg['token']))  echo $err_msg['token']; ?>
            </div>

          <div class="btn-container">
            <input type="submit" class="btn btn-mid" value="送信">
          </div>
        </form>
      </div>
    </section>

  </div>

  <?php
 require('footer.php');
?>