<?php
require('function.php');

debug('                  ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　マイメモ画面　」');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();


// ログイン認証
require('auth.php');

if (empty($_SESSION['login_date'])) {
    header('Location:index.php');
    debug('SESSIONがなかったためトップ画面に遷移します');
}

//==============================
//画面処理
//==============================
//画面表示用データ取得
//==============================
// GETパラメータを取得
//------------------------------
//商品IDのGETパラメータを取得
$memo_id = (!empty($_GET['m_id'])) ? $_GET['m_id'] : '';
// ユーザーIDをセッションから取得
$u_id = $_SESSION['user_id'];

// DBからcategoryテーブルの中身を取得
$categories = getCategory();
// DBからユーザーIDが当てはまるmemoテーブルの中身を取得
$memos = getMemoData($u_id);
// debug('$categoriesの中身：'.print_r($categories, true));
 debug('$memosの中身：'.print_r($memos, true));
$display_memos = array();

// カテゴリーを全件回す
foreach ($categories as $category) {
    // メモのカテゴリーIDをキーに、連想配列へ格納する
    if ($category['user_id'] === $u_id) {
        $display_memos[$category['id']]['category'] = $category;
    }
}

// メモを全件回す
foreach($memos as $memo){
  // メモのカテゴリーIDをキーに、連想配列へ格納する
  debug('$memosの$memoの中身：'.print_r($memo, true));
  $display_memos[$memo['category_id']]['memo'][] = $memo;
  $display_memos_memo = $display_memos[$memo['category_id']]['memo'];
  debug('$display_memos_memoの中身：'.print_r($display_memos_memo, true));
}

// debug('display_memosの中身：'.print_r($display_memos, true));

// POST送信の有無のチェック
if (!empty($_POST)) {
    debug('POST送信があります。');
    debug('削除内容のPOST送信内容：'.print_r($_POST, true));

    $c_id = $_POST['c_id'];
    $m_id = $_POST['m_id'];
    debug('$c_idの中身：'.print_r($c_id, true));
    debug('$m_idの中身：'.print_r($m_id, true));

    // 例外処理
    try {
        // DBに接続
        $dbh = dbConnect();
        // $m_idの有無チェックで以下のSQL文を分岐させる
        if (empty($m_id)) {
            // SQL文作成
            $sql1 = 'UPDATE memo SET delete_flg = 1 WHERE user_id = :u_id AND category_id = :c_id';
            $sql2 = 'UPDATE category SET delete_flg = 1 WHERE user_id = :u_id AND id = :c_id';
            $data = array(':u_id' => $u_id, ':c_id' => $c_id);

            // debug('SQLの中身：'.print_r($sql1, true));
            // debug('SQLの中身：'.print_r($sql2, true));
            // debug('流し込みデータ：'.print_r($data, true));


            $stmt1 = queryPost($dbh, $sql1, $data);
            $stmt2 = queryPost($dbh, $sql2, $data);
            // クエリ実行成功の場合
            if ($stmt2) {
                debug('メモのリストが削除されました。');
                $_SESSION['msg_success'] = SUC07;
                header("Location:myMemo.php");
            } else {
                debug('クエリ失敗しました。');
                $err_msg = MSG07;
            }
        } else {
            // $m_idがある場合（メモ単体を消す場合）
            // SQL文作成
            $sql = 'UPDATE memo SET delete_flg = 1 WHERE user_id = :u_id AND id = :m_id';
            $data = array(':u_id' => $u_id, ':m_id' => $m_id);

            // debug('SQLの中身：'.print_r($sql2, true));
            // debug('流し込みデータ：'.print_r($data, true));
        
            $stmt = queryPost($dbh, $sql, $data);

            if ($stmt) {
                debug('メモ単体を削除しました。');
                $_SESSION['msg_success'] = SUC08;
                header("Location:myMemo.php");
            } else {
                debug('クエリ失敗しました。');
                $err_msg = MSG07;
            }
        }
    } catch (Exception $e) {
        error_log("エラー発生：".$e->getMessage());
        debug('SQL実行失敗しました');
        $err_msg['common'] = MSG07;
    }
}

debug('画面表示処理終了<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');

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

<p id="js-show-msg" class="msg-slide" style="display:none;">
<?php
echo getSessionFlash('msg_success');
debug('サクセスメッセージを出しました');
?>
</p>




  <!-- メインコンテンツ -->
 <div id="mymemo-main">

 
  <div id="page-panel">
   <?php
    //  画面描画用の連想配列でループを回す
    foreach ($display_memos as $category_id => $display_memo) {
      // debug('$display_memoの中身：'.print_r($display_memo, true));
        
      // 現在のカテゴリ情報とメモリストを取得する
        $category = $display_memo['category'];
      
        // もし$display_memo['memo']があれば$memo_by_categoryに格納する（下のif文を入れると未メモ有カテゴリに最新メモが入ってしまう）
        // if (!empty($display_memo['memo'])) {
            $memos_by_category = $display_memo['memo'];
        //  }
        debug('$memos_by_categoryの中身：'.print_r($memos_by_category, true));
        
        ?>
   

  <!-- メモの大枠 -->
    
  <section class="list-wrap">
   
    <div class="list-panel">
      <!-- メモのヘッダー -->
      <div class="list-header">
        <!-- カテゴリ名を出力（PHP） -->
        <h2 class="list-title"><?php echo sanitize($category['name']); ?></h2>
         <form method ="post" action="" onSubmit="return check()">
        <div class="list-header-icon">
          <button type="submit" class="btn-dele" name="c_id" value="<?php echo sanitize($category['id']); ?>"><i class="fas fa-trash-alt"></i></button>
          <a href="list.php?c_id=<?php echo sanitize($category['id']); ?>"><i class="fas fa-edit"></i></a>
        </div>
         </form>
      </div>
          
          <?php
          foreach ((array)$memos_by_category as $memo_by_category) {
              ?>
      <!-- メモの内容（タイトル部分） それの繰り返し -->
      <div class="memo-panel">
        <div class="list-memo-title">
          <?php
          if (!empty($memos_by_category)) {
              echo sanitize(($memo_by_category['name']));
          }else{
            echo '';
          }
          ?>
        </div>
      <!-- GETパラメータを取れるように各メモのIDを呼び出す。 -->
       <form method ="post" action="" onSubmit="">
          <div class="memo-panel-icon">
              <a href="memoDetail.php?m_id=<?php echo sanitize($memo_by_category['id']); ?>"><i class="fas fa-bars"></i></a>
              <!-- ゴミ箱アイコン -->
                <button type="submit" class="btn-dele" name="m_id" value="<?php echo sanitize($memo_by_category['id']); ?>"><i class="far fa-trash-alt"></i></button>
          </div>
       </form>
        <!-- メモ日付 -->
        <p style="font-size:0.8em;">
          <?php echo sanitize($memo_by_category['update_date']); ?>
        </p>
      </div>
    <?php
       }
    ?>

      <div class="memo-add">
        <span><a href="memoDetail.php?c_id=<?php echo sanitize($category['id']); ?>"><i class="fas fa-pen-square"></i>さらにメモを追加する</a></span>
      </div>
     </div>
    
   </section>
  <?php
  }
 ?>

  </div>
</div>


  <?php
 require('footer.php');
 ?>

