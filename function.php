<?php 
//==============================
//ログ
//==============================
//ログをとるか
ini_set('log_errors', 'on');
//ログの出力ファイル
ini_set('error_log', 'php.log');


//==============================
//デバッグ
//==============================
//デバッグフラグ（trueならデバッグをとる）
$debug_flg = true;
function debug($str){
  global $debug_flg;
  if(!empty($debug_flg)){
    error_log('デバッグ：'.$str);
  }
}

//==============================
//セッション準備・セッションの有効期限を伸ばす
//==============================
// セッションファイルの置き場を変更（/tmp/ではなく、/var/tmp/に置くと30日は削除されない）
session_save_path("/var/tmp/");
// サーバに保存されているセッションファイルの保存期間を設定（30日以上たっているものに対してだけ100分の1の確率で削除）
// session.gc_maxlifetime = 1440秒（24分）がデフォルトでの設定→30日（60*60*24*30）に変更
ini_set('session.gc_maxlifetime', 60*60*24*30);
// クッキーの有効期限を伸ばす（session.gc_maxlifetime のみ変更をしても、デフォルトだとブラウザを閉じたらセッションが破棄されるため。）
// session.cookie_lifetime = 0がデフォルト（ブラウザを閉じるまでという意味）
ini_set('session.cookie_lifetime', 60*60*24*30);
// セッションを使う
session_start();
// 現在のセッションIDを新しく生成したものと置き換える（なりすましのセキュリティ対策）
session_regenerate_id();

//==============================
//画面表示処理開始ログ吐き出し関数
//==============================
// セッションを使う
function debugLogStart(){
  debug('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>画面表示処理開始');
  debug('セッションID：'.session_id());
  debug('セッション変数の中身：'.print_r($_SESSION, true));
  debug('現在日時のタイムスタンプ：'.time());
  if(!empty($_SESSION['login_date']) && !empty($_SESSION['login_limit'])){
    debug('ログイン期限日時タイムスタンプ：'.($_SESSION['login_date'] + $_SESSION['login_limit']));
  }
}

//==============================
//定数設定
//==============================
// エラーメッセージを定数に格納
define('MSG01', '入力必須です');
define('MSG02', 'Emailの形式で入力してください');
define('MSG03', 'パスワード（再入力）が合っていません');
define('MSG04', '半角英数字のみご利用いただけます');
define('MSG05', '6文字以上で入力してください');
define('MSG06', '256文字以内で入力してください');
define('MSG07', 'エラーが発生しました。しばらく経ってからやり直してください');
define('MSG08', 'そのEmailはすでに登録されています');
define('MSG09', 'メールアドレス、もしくはパスワードが不正です');
define('MSG10', '日本語で入力してください');

//==============================
//グローバル変数
//==============================
//エラーメッセージ格納用の配列
$err_msg = array();

//==============================
//バリデーション関数
//==============================
// 未入力チェック
//$str = フォームに入力する文字列
// $key = input要素の name属性（今回はemail, username, pass, pass_re）
function validRequired($str, $key){
  if(empty($str)){
    global $err_msg;
    $err_msg[$key] = MSG01;
  }
}

// Email形式チェック
function validEmail($str, $key){
  if(!preg_match('|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|', $str)){
    global $err_msg;
    $err_msg[$key] = MSG02;
  }
}
// Email重複チェック
// 引数を$emailではなく$strにするとだめ。使えない。
function validEmailDup($email){
    global $err_msg;
 
    try {

    // DB接続
        $dbh = dbConnect();
        $sql = 'SELECT email FROM user WHERE email = :email AND delete_flg = 0';
        //emailと count(*)の違いがわからない。調べること
        $data = array(':email' => $email);
        // クエリ実行
        $stmt = queryPost($dbh, $sql, $data);
        // クエリの結果を取得する
        //fetch:取り出す。Assoc:Associationで、連想する
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        debug('Email重複チェック  $resultの中身：'.print_r($result));
    
        //取得した結果、値が入っているかどうかをチェックする
        if (!empty($result)) {
            $err_msg['email'] = MSG08;
        }
    } catch (Exeption $e) {
        error_log("エラー発生：" . $e->getMessage());
        $err_msg['common'] = MSG07;
        debug('email重複チェックできず');
    }
}


// username形式チェック（日本語のみ入力可能）
function validUsername($str, $key){
  if (!preg_match('/^[ぁ-んァ-ヶー一-龠]+$/u', $str)) {
      global $err_msg;
      $err_msg[$key] = MSG10;
    }
}

// 同値チェック
function validMatch($str1, $str2, $key){
  if($str1 !== $str2){  //$str1,2が同じではない時
    global $err_msg;
    $err_msg[$key] = MSG03;
  }
}

// 最大文字数チェック
function validLenMax($str, $key, $max = 255){
  if(mb_strlen($str) > $max){
    global $err_msg;
    $err_msg[$key] = MSG06;
  }
}

// 最小文字数チェック
function validLenMin($str, $key, $min = 6){
  if(mb_strlen($str) < $min){
    global $err_msg;
    $err_msg[$key] = MSG05;
  }
}

// 半角英数字チェック
function validHalfAZ09($str, $key){
  if(!preg_match('/^[a-zA-Z0-9]+$/', $str)){
    global $err_msg;
    $err_msg[$key] = MSG04;
  }
}

//==============================
//データベース
//==============================
//DB接続関数
function dbConnect(){
  // mySQLなら
  $dsn = 'mysql:dbname=memopa;host=localhost;charset=utf8mb4';
  $user = 'root';
  $pass = 'root';
  $driver_options = array(
  // SQL実行でエラーが起こった際にどう処理するか指定
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  //デフォルトフェッチモードを連想配列形式に設定
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  //バッファードクエリを使う（一度に結果セットをすべて取得し、サーバー負荷を軽減）
  //SELECTで得た結果に対してもrowCountメソッドを使えるようにする
  PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
);

  // PDOオブジェクト生成
  $dbh = new PDO($dsn, $user, $pass, $driver_options);
  return $dbh;
}

// queryPost関数
//==============================
// $sql = 今後作成するSQL文
// $data = プレースホルダーの値
function queryPost($dbh, $sql, $data)
{
    // SQL文作成（クエリー作成）
    $stmt = $dbh->prepare($sql);
    //プレースホルダに値をセットし、SQL文を実行
    if (!$stmt->execute($data)) {
        debug('クエリに失敗しました。');
        debug('SQLエラー：'.print_r($stmt, true));
        debug('SQLエラー(Code)：' . $stmt->errorCode());
        debug('SQLエラー(Info)：' . serialize($stmt->errorInfo()));

        $err_msg['common'] = MSG07;
        return 0;
    } else {
        debug('クエリ成功。');
        return $stmt;
    }
}

//==============================
//パスワードハッシュ化関数
//==============================



?>
