<?php
require('function.php');

debug('                  ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　ログイン画面　」');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();


$_SESSION['username'] = "クルトン";
// このusernameは消しても「クルトン」ってphp.logに残る

// ログイン認証
require('auth02.php');
//==============================
//画面処理
//==============================
//post送信の有無
if (!empty($_POST)) {
  debug('POST送信があります');

  // 変数にユーザー情報を代入
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $pass_re = (!empty($_POST['pass_re']))? true : false;

    // emailの形式チェック
    validEmail($email, 'email');
    // emailの最大文字数チェック
    validLenMax($email, 'email');

    // パスワードの半角英数字チェック
    validHalfAZ09($pass, 'pass');
    // パスワードの最小文字数チェック
    validLenMin($pass, 'pass');
    // パスワードの最大文字数チェック
    validLenMax($pass, 'pass');

    // 未入力チェック
    validRequired($email, 'email');
    validRequired($pass, 'pass');

    // ここまでエラーメッセージがなければ、DBのpassと入力したpassを照合
    if (empty($err_msg)) {
      debug('バリデーションチェックOK');

      try{
        // DBへ接続
        $dbh = dbConnect();
        // SQL文作成
        // 入力したemailをもとにpassとidを取ってくる。
        $sql = 'SELECT password, id FROM user WHERE email = :email AND delete_flg = 0';
        $data = array(':email' => $email);
        // クエリ実行
        $stmt = queryPost($dbh, $sql, $data);
        // 実行結果を取ってくる。
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        debug('SQL実行結果の中身'.print_r($result,true));
        debug('入力されたpass:'.print_r($pass, true));

        // 実行結果のうち、passwordの配列の方だけ使用するのでarray_shiftで最初の配列を取得。
        if(!empty($result) && password_verify($pass, array_shift($result))){
        debug('パスワードがマッチしました。');
        
        // ユーザーIDを格納
        $_SESSION['user_id'] = $result['id'];

        // 最終ログイン日時を現在日時に
        $_SESSION['login_date'] = time();
        // ログイン有効期限を変数を作り、設定（60秒*60分）
        $session_limit = 60*60;

        // ログイン保持にチェックがある場合
        if(!empty('pass_save')){
          debug('ログイン保持にチェックがあります');
          // ログイン有効期限を30日にする
          $_SESSION['login_limit'] = $session_limit*24*30;
          debug('ログイン有限期限：'.print_r($_SESSION['login_limit'], true));
        }else{
          debug('ログイン保持にチェックがありません');
          // ログイン有限期限を1時間にする
          $_SESSION['login_limit'] = $session_limit;
          debug('ログイン有限期限：'.print_r($_SESSION['login_limit'], true));
        }

        header('location:myMemo.php');
        }else{
          debug('パスワードアンマッチです');
          $err_msg['common'] = MSG09;
        }
      }catch(Exception $e){
        error_log("エラー発生：". $e->getMessage());
        $err_msg['common'] = MSG07;
      }
    }
}
debug('画面表示処理終了<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');

?>

<?php
$siteTitle = 'ログイン画面';
 require("head.php");
?>

<body class="page-logined page-1colum">

<!-- ヘッダー  -->
<header>
  <div class="site-width">
    <h1><a href="myMemo.php">memopa</a></h1>
    <nav id="top-nav">
      <ul>
        <li><a href="myProf.php">マイプロフ</a></li>
        <li><a href="signup.php">新規会員登録</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- メインコンテンツ -->
<div id="contents" class="site-width">

<!-- Main -->
<section id="main">
    <div class="form-container">
        <form action="" method="post" class="form">
          <h2 class="title">ログイン</h2>

          <div class="area-msg">
           <?php
             if (!empty($err_msg['common'])) echo $err_msg['common'];
            ?>
           </div>
          <!-- メールアドレス -->
          
            <label class="">メールアドレス</label>
            <input type="text" name="email" placeholder="emailの形式で入力してください" value="<?php if(!empty($_POST['email'])) echo $_POST['email']; ?>">
            <div class="area-msg">
              <?php if(!empty($err_msg['email']))  echo $err_msg['email']; ?>
            </div>
        
          <!-- パスワード -->
            <label class="">パスワード</label>
            <input type="password" name="pass" placeholder="６文字以上で入力してください。" value="<?php if(!empty($_POST['pass'])) echo $_POST['pass']; ?>">
            <div class="area-msg">
              <?php if (!empty($err_msg['pass']))  echo $err_msg['pass']; ?>
            </div>


            <div class="checkbox01">
              <label>
                <input type="checkbox" name="pass_save" class="checkbox01-input">
                <span class="checkbox01-parts">次回ログインを省略する</span>
              </label>
            </div>

          <div class="btn-container">
            <input type="submit" class="btn btn-mid" value="ログイン">
          </div>
          <span class="help-block">
            パスワードを忘れた方は<a href="passRemindSend.html">コチラ</a>
          </span>
        </form>
    </div>
</section>

</div>

<?php
 require('footer.php');
 ?>