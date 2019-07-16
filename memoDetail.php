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
// GETデータを格納
// メモID＝memo_id
// memo_idが空なら空文字を入れる
$memo_id = (!empty($_GET['memo_id'])) ? $_GET['memo_id'] : '';
// DBからメモデータを取得
$dbMemoData = (!empty($memo_id)) ? getMemo($_SESSION['user_id'], $memo_id) : '';
// DBからメモのカテゴリを取得
$dbMemoCategory = getMemoCategory();
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
                $sql = 'UPDATE memo SET category_id = :memolist, name = :name, contents = :contents, WHERE user_id = :u_id AND id = :m_id ';
                $data = array(':memolist' => $m_list, ':name' => $m_title, ':contents' => $m_contents, ':u_id' => $_SESSION['user_id'] , ':m_id' => $memo_id);
            } else {
                debug('新規作成画面なのでDB登録です。');
                $sql = 'INSERT INTO memo (category_id, name, contents, user_id, create_date) VALUES (:memolist, :name, :contents, :u_id, :date)';
                $data = array(':memolist' => $m_list, ':name' => $m_title, ':contents' => $m_contents, ':u_id' => $_SESSION['user_id'], ':date' => date('Y-m-d H:i:s'));
            }
            debug('SQLの中身：'.print_r($sql, true));
            debug('流し込みデータ：'.print_r($data, true));
            // クエリ実行
            $stmt = queryPost($dbh, $sql, $data);

            // クエリ成功の場合
            if ($stmt) {
               $_SESSION['msg_success'] = SUC04;
   debug('マイページへ遷移します。');
    header("location:myMemo.php"); //マイページへ	// 編集画面なら
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
       
          <label class="memolist <?php if (!empty($err_msg['memolist'])) echo 'err'; ?>">
            リスト
           </label>
            <div class="select-wrap">
            <select class="select-cate" name="memolist" id="">
              <option value=" <?php if (getFormData('category_id') == 0) {
                                echo 'selected';
                              } ?>">no name</option>
              <?php
              foreach ($dbMemoCategory as $key => $val) {
                ?>
                <option value="<?php echo $val['id'] ?>" <?php if (getFormData('memolist') == $val['id']) {
                                                            echo 'selected';
                                                          } ?>>
                  <?php echo $val['name']; ?>
                </option>
              <?php
            }
            ?>
            </select>
            </div>
         
          <div class="area-msg">
            <?php
            if (!empty($err_msg['memolist'])) echo $err_msg['memolist'];
            ?>
          </div>

        <!-- タイトル -->
          <label class="memo-title  <?php if(!empty($err_msg['memotitle'])) echo "err"; ?>">タイトル
          <input type="text" name="memotitle" value="<?php echo getFormData('name'); ?>">
          <div class="area-msg">
              <?php echo getErr_msg('memotitle'); ?>
            </div>
          
          </label>

        <!-- メモ内容 -->
          <label class="memo-contents <?php if(!empty($err_msg['contents'])) echo "err"; ?>">メモ</label>
          <textarea name="contents" id="memo-area" cols="30" rows="10" value="<?php echo getFormData('contents'); ?>"></textarea>
          <div class="area-msg">
              <?php echo getErr_msg('contents'); ?>
            </div>

          <div class="btn-container">
            
            <input type="submit" class="btn btn-mid btn-Edit" value="<?php echo (!$edit_flg) ? '新規作成' : '編集' ?>">
            <input type="submit" class="btn btn-mid btn-del" value="削除する">
          </div>

          <label class="prev-a">
            <a href="myMemo.php">&lt;&lt;前のページに戻る</a>
          </label>

        </form>
      </div>

    </section>

  </div>

  <!-- footer -->
  <?php
 require('footer.php');
?>