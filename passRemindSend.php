<?php
// 共有変数・関数ファイルを読み込み
require('function.php');

debug('                  ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　パスワード再発行メール送信ページ　」');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

// ログイン認証はいらない（ログインできない人が使う画面だから）

//==============================
// 画面処理
//==============================

//メールアドレスが入力されたら（POST送信されたら）
if (!empty($_POST)) {
  debug('ポスト送信があります。');
  debug('ポスト情報：'.print_r($_POST, true));

  // 変数定義
  $email = $_POST['email'];

          // email形式チェック
          validEmail($email, 'email');
          // 最大文字数チェック
          validLenMax($email, 'email');
          // 最小文字数チェック
          validLenMin($email, 'email');
          // 半角英数字チェック
          validHalfAZ09($email, 'email');

          // 未入力チェック
          validRequired($email, 'email');


    if(!empty($err_msg)){
      debug('バリデーションチェックOKです');
        // 例外処理
        try{
          // DB接続
          $dbh = dbConnect();
          // SQL文作成(メールアドレスがあるかどうかを確認する文)
          // count関数で入力したメアドとDBにあるメアドの合致数を取得する
          $sql = 'SELECT count(*) FROM user WHERE email = :email AND delete_flg = 0';
          $data = array(':email' => $email);
          // クエリ実行
          $stmt = queryPost($dbh, $sql, $data);
          $result = $stmt->fetch(PDO::FETCH_ASSOC);
          debug('$resultの結果：'.print_r($result, true));

          // メアドが登録されていた場合
          // array_shift関数：配列の1番最初の値を取得する関数
          if($stmt && array_shift($result)){
            debug('クエリ成功。DBに登録されていました。');
            debug('画面を更新する');
            $_SESSION['msg_success'] = SUC03;

            // 認証キーを作成する
            $auth_key = makeRandKey();
            debug('認証キー生成完了');
            debug('認証キー：'.print_r($auth_key, true));

            // メール送信
             // メールの送信先
              $to = $_POST['email'];
              // タイトル：
              $title = 'パスワード再発行　認証メール｜memopa';
              // 相手：(メールアドレス)
              $username = $_POST['email'];
              // 送信に使う自分のメールアドレス：
              $from = 'cherry.papapa.921.gmail';
              // 本文：
              $contents = <<<EOT
{$username}  さん

本メールアドレス宛にパスワード再発行のご依頼がありました。
下記のURLにて認証キーをご入力いただくとパスワードが再発行されます。

パスワード再発行認証キー入力ページ：http://memopa.site/passRemindRecieve.php
認証キー：{$auth_key}
＊認証キーの有効期限は30分となります

認証キーを再発行されたい場合は下記ページより再度再発行をお願い致します。
http://memopa.site/passRemindSend.php



///////////////////////////////////////
memopa
URL:  http://memopa.site
///////////////////////////////////////
EOT;

        sendEmail($to, $title, $contents, $username);
        debug('メールを送信しました。');
        debug('$contentsの中身：'.print_r($contents, true));

        // この認証キーと認証emailを持っていなければ、認証キー入力画面に入っても意味がないようにする。
        $_SESSION['auth_key'] = $auth_key;
        $_SESSION['auth_email'] = $email;
        $_SESSION['auth_limit'] = time() + (60*30);  //現在時刻より30分間有効
        debug('$_SESSIONの中身：'.print_r($_SESSION, true));

        header('Location:passRemindRecieve.php');
        }else{
          debug('クエリに失敗したかDBに登録のないemailが入力されました。');
          $err_msg['common'] = MSG07;

        }
      }catch(Exception $e){
        error_log('エラー発生：'.$e->getMessage());
        $err_msg['common'] = MSG07;

      }
    }
  }
  
debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');





?>

<?php
$siteTitle = 'パスワード再発行メール送信';
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
          <h2 class="title">パスワード再設定</h2>
            <div class="pass-text">
              <p>memopaに登録した際のメールアドレスを入力してください。</p>
            <div>

          <div class="area-msg">
           <?php 
            if(!empty($err_msg['common'])) echo $err_msg['common'];
            ?>
          </div>

          <!-- メールアドレス -->
          <label class="<?php if(!empty($err_msg['email'])) echo $err_msg['email'];?>">メールアドレス
          <input type="text" name="email" placeholder="emailの形式で入力してください">
          </label>
          
          
          <div class="area-msg">
           <?php 
            if(!empty($err_msg['email'])) echo $err_msg['email'];
            ?>
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