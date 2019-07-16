<?php
// 共通変数・関数ファイルを読み込み
require('function.php');

debug('                  ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　メモ編集画面　」');
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


// GETデータを格納
// メモID＝memo_id
// memo_idが空なら空文字を入れる
$memo_id = (!empty($_GET['memo_id'])) ? $_GET['memo_id'] : '';
// DBからメモデータを取得
$dbMemoData = (!empty($memo_id)) ? getMemo($_SESSION['user_id'], $memo_id) : '';
// DBからメモのカテゴリを取得
$dbMemoCategory = MemoCategory();
// 新規メモ作成画面か、編集画面か判別する
// 新規作成ならfalse, 編集ならtrue
$edit_flg = (empty($dbMemoData)) ? false : true;
debug('メモID情報：'.print_r($memo_id, true));
debug('メモデータ（DB）情報：'.print_r($dbMemoData, true));
debug('メモのカテゴリを表示：'.print_r($dbMemoCategory, true));


// パラメータ改ざんチェック
//==============================
//GETパラメータはあるが、改ざんされている（URLをいじくった）場合、正しいメモデータが取れないのでマイプロフへ遷移させる
// if(!empty($memo_id) && empty($dbMemoData)){
//   debug('GETパラメータの商品IDは違います。マイプロフへ遷移します');
//   header("Location:")
// }

// パラメータ改ざんチェック
//==============================
// POST送信チェック
if (!empty($_POST)) {
  debug('POST送信があります。');
  debug('POST情報：'.print_r($_POST, true));

// 変数にユーザー情報を代入
    $m_list = $_POST['memolist'];
    $m_title = $_POST['memotitle'];
    $m_contents = $_POST['contents'];

    // 新規登録だったら（メモデータがなければ）
    if (empty($dbMemoData)) {
        // 未入力チェック
        validRequired($m_title, 'memotitle');
        validRequired($m_contents, 'contents');
    } else {
        // メモタイトルが更新されたら
        if ($dbMemoData['name'] !== $m_title) {
            // 最大文字数チェック
            validLenMax($m_title, 'memotitle');
            // 未入力チェック
            validRequired($m_title, 'memotitle');
        }

        // メモ内容が更新されたら
        if ($dbMemoData['contents'] !== $m_contents) {
            // 未入力チェック
            validRequired($m_contents, 'contents');
        }
        // もしDBのメモリスト、メモタイトル、メモ内容と入力したものが異なっていたら
        // if ($dbMemoData['category_id'] !== $m_list) {
        // //  セレクトボックスチェック
        //    validSelect($m_list, 'memolist');
        // }
        // !!!!!!!あとでカテゴリテーブルとつなげること!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    }
    // ここまでエラーメッセージがなければ
    if (empty($err_msg)) {
      debug('バリデーションOKです。');

    // 例外処理
        try {
            // DB接
            $dbh = dbConnect();
            // SQL文作成
            // 新規作成画面なら、INSERT。編集画面の場合は、UPDATE。
            if ($edit_flg) {
                debug('編集画面なのでDB更新です。');
                $sql = 'UPDATE memo SET name = :name, contents = :contents, category_id = :m_list, WHERE user_id = :u_id AND id = :m_id ';
                $data = array(':name' => $m_title, ':contents' => $m_contents, ':m_list' => $m_list, ':u_id' => $_SESSION['user_id'] , ':m_id' => $memo_id);
            } else {
                debug('新規作成画面なのでDB登録です。');
                $sql = 'INSERT INTO memo (name, contents, category_id, user_id, create_date) VALUES (:name, :contents, :m_list, :u_id, :date)';
                $data = array(':name' => $m_title, ':contents' => $m_contents, ':m_list' => $m_list, ':u_id' => $_SESSION['user_id'], ':date' => date('Y-m-d H:i:s'));
            }
            debug('SQLの中身：'.print_r($sql, true));
            debug('流し込みデータ：'.print_r($data, true));
            // クエリ実行
            $stmt = queryPost($dbh, $sql, $data);

            // クエリ成功の場合
            if ($stmt) {
                if ($edit_flg) {
                    //  編集画面なら
                    $_SESSION['msg_success'] = SUC04;
                    debug('マイメモに遷移します。');
                    header("location: myMemo.php");
                } else {
                    // 新規作成画面なら
                    $_SESSION['msg_success'] = SUC05;
                    debug('マイメモに遷移します。');
                    header("location: myMemo.php");
                }
                
            }
        } catch (Exceptiojn $e) {
            err_lo('エラー発生'.$e->getMessage());
            $err_msg['common'] = MSG07;
        }
    }
}

debug('画面表示処理終了<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');


?>

<!-- $edit_flgを使い、$dbMemoDataがカラかどうかを見ている。falseなら新規作成、trueなら編集 -->
<?php
// $dbMemoDataが空でなければtrue(編集)を表示させる
// $siteTitle = (!$edit_flg) ? 'メモ登録' : 'メモ編集';
 if (!$edit_flg) {
    $siteTitle  =  'メモ新規作成';
} else {
    $siteTitle = 'メモ編集';
}

 require("head.php");
?>

<body class="page-login page-1colum">

<style>
    .form .btn {
      float: none;
      margin: 30px 15px;
    }

    .form {
      text-align: center;
    }

    /* 編集ボタン */
    .form .btn-Edit{
      background: #5bbfea;
    }

    .form .btn-Edit:hover{
      background: #22A8E2;
    }

    /* 削除ボタン */
    .form .btn-del{
      background: #EA534F;
      color: #fff;
    }
    .form .btn-del:hover{
      background: #f90902;
    }
  </style>

  <!-- ヘッダー  -->
<?php 
require('header.php');
?>

  <!-- メインコンテンツ -->
  <div id="contents" class="site-width">

    <!-- Main -->
    <section id="main">
      <div class="form-container">
        <h2 class="title">
          <?php echo (!$edit_flg) ? 'メモ新規作成' : 'メモ編集'; ?>
        </h2>
        <form action="" method="post" class="form">

         <div class="area-msg">
           <?php 
            if(!empty($err_msg['common'])) echo $err_msg['common'];
            ?>
        </div>

        <!-- リスト名 -->
       
          <label class="memo-list  ">リスト
          <input type="text" name="memolist">
          </label>

        <!-- タイトル -->
          <label class="memo-title  <?php if(!empty($err_msg['memotitle'])) echo $err_msg['memotitle']; ?>">タイトル
          <input type="text" name="memotitle" value="">
          <div class="area-msg">
              <?php echo getErr_msg('memotitle'); ?>
            </div>
          
          </label>

        <!-- メモ内容 -->
          <label class="memo-contents <?php if(!empty($err_msg['memotitle'])) echo $err_msg['memotitle']; ?>">メモ</label>
          <textarea name="contents" id="memo-area" cols="30" rows="10" value=""></textarea>
          <div class="area-msg">
              <?php echo getErr_msg('contents'); ?>
            </div>

          <div class="btn-container">
            <input type="submit" class="btn btn-mid btn-Edit" value="編集する">
            <input type="submit" class="btn btn-mid btn-del" value="削除する">
          </div>

          <label class="prev-a">
            <a href="memoContents.html">&lt;&lt;前のページに戻る</a>
          </label>

        </form>
      </div>

    </section>

  </div>

  <!-- footer -->
  <footer id="footer">
    Copyright memopa. All Rights Reserved.
  </footer>

  <!-- innnerHeightに関しての参考記事→ https://www.flatflag.nir87.com/height-1083 -->
  <!-- innerHeight = 要素＋padding(borderの内側)を取得 -->
  <!-- outerHeight = 要素＋padding+borderを取得 -->
  <!-- window ＝ 画面上に出てくる小さい画面のこと-->
  <script> src = "js/vendor/jquery-3.4.1.min.js"</script>
  <script>
    $(function () {
      var $ftr = $('#footer');
      if (window.innerHeight() > $ftr.offset().top + $ftr.outerHeight()) {
        $ftr.attr({ 'style': 'position: fixed; top:' + (window.innerHeight - $ftr.outerHeight()) + 'px;' });
      }
    });
  </script>

</body>

</html>