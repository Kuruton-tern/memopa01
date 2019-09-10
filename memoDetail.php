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
// メモID＝m_id
// m_idが空なら空文字を入れる
$m_id = (!empty($_GET['m_id'])) ? $_GET['m_id'] : '';
// c-idが空なら空文字を入れる
$c_id = (!empty($_GET['c_id'])) ? $_GET['c_id'] : '';
// ユーザーIDをセションより取得
$u_id = $_SESSION['user_id'];

// DBからメモデータを取得
// ここで$dbFormDataと名前を定義しないとgetFormData関数が使えない
$dbFormData = (!empty($m_id)) ? getMemo($u_id, $m_id) : '';
// DBからメモのカテゴリを取得
$dbCategory = getMemoCategory($u_id);  //$dbMemoCategoryだったもの
// 新規メモ作成画面か、編集画面か判別する
// 新規作成ならfalse, 編集ならtrue
$edit_flg = (empty($dbFormData)) ? false : true;


debug('メモID情報：'.print_r($m_id, true));
debug('フォームに表示させるメモデータ（$dbFormData）情報：'.print_r($dbFormData, true));
debug('メモのカテゴリ（$dbCategory）を表示：'.print_r($dbCategory, true));
debug('edit_flgの中身：'.print_r($edit_flg, true));
debug('$_GETの中身：'.print_r($_GET, true));


// パラメータ改ざんチェック
//==============================
//GETパラメータはあるが、改ざんされている（URLをいじくった）場合、正しいメモデータが取れないのでマイプロフへ遷移させる
if(!empty($m_id) && empty($dbFormData)){
   debug('GETパラメータの$m_idは違います。マイメモに移動します');
   header("Location:myMemo.php");
 }

// POST送信時処理
//==============================
// POST送信チェック
if (!empty($_POST)) {
    debug('POST送信があります。');

    debug('POST情報：'.print_r($_POST, true));

    // 変数に入力情報を代入
    $m_c_id = $_POST['category_id'];
    $m_title = $_POST['memotitle'];
    $m_contents = $_POST['contents'];
    debug('$m_c_idの中身：'.print_r($m_c_id, true));
    // メモ削除ボタンを押したら
    $dele = $_POST['dele'];

       // メモの内容の暗号化
        encContents($m_contents);
        debug('encContentsの中身：'.print_r(encContents($m_contents), true));



    // 新規登録だったら（メモデータがなければ）
    if (empty($dbFormData)) {
        // 未入力チェック
        validRequired($m_title, 'memotitle');
        validRequired($m_contents, 'contents');
        validSelect($m_c_id, 'category_id');
        
    } else {
        // メモタイトルが更新されたら
        if ($dbFormData['name'] !== $m_title) {
            // 最大文字数チェック
            validLenMax($m_title, 'memotitle');
            // 未入力チェック
            validRequired($m_title, 'memotitle');
        }

        // メモ内容が更新されたら
        if ($dbFormData['contents'] !== $m_contents) {
            // 未入力チェック
            validRequired($m_contents, 'contents');
          
        }
        // もしDBのメモリストと入力したものが異なっていたら
        if ($dbFormData['category_id'] !== $m_c_id) {
            //  セレクトボックスチェック
            validSelect($m_c_id, 'category_id');
        }
    }

    // ここまでエラーメッセージがなければ
    if (empty($err_msg)) {
        debug('バリデーションOKです。');

        // 例外処理
        try {
            // DB接続
            $dbh = dbConnect();
            // $_POST['dele]の有無チェック
            if (empty($_POST['dele'])) {
                if ($edit_flg) {
                    debug('編集画面なのでDB更新です。');
                    // SQL文作成
                    // 新規作成画面なら、INSERT。編集画面の場合は、UPDATE。
                    $sql = 'UPDATE memo SET category_id = :category_id, name = :name, contents = :contents, update_date = :date WHERE user_id = :u_id AND id = :m_id';
                    $data = array(':category_id' => $m_c_id, ':name' => $m_title, ':contents' => encContents($m_contents), ':date' => date('Y-m-d H:i:s') , ':u_id' => $_SESSION['user_id'] , ':m_id' => $m_id);
                } else {
                    debug('新規作成画面なのでDB登録です。');
                    $sql = 'INSERT INTO memo (category_id, name, contents, user_id, create_date) VALUES (:category_id, :name, :contents, :u_id, :date)';
                    $data = array(':category_id' => $m_c_id, ':name' => $m_title, ':contents' => encContents($m_contents), ':u_id' => $_SESSION['user_id'], ':date' => date('Y-m-d H:i:s'));
                }
                debug('SQLの中身：'.print_r($sql, true));
                debug('流し込みデータ：'.print_r($data, true));
                // クエリ実行
                $stmt = queryPost($dbh, $sql, $data);

                // クエリ成功の場合
                if ($stmt) {
                    $_SESSION['msg_success'] = SUC05;
                    debug('マイページへ遷移します。');
                    header("location:myMemo.php"); //マイページへ
                }
            } else {
                // SQL文作成
                $sql = 'UPDATE memo SET delete_flg = 1 WHERE id = :id AND user_id = :u_id';
                $data = array( ':id' => $m_id, ':u_id' => $u_id);

                // クエリ実行
                $stmt = queryPost($dbh, $sql, $data);

                // クエリ成功の場合
                if ($stmt) {
                    debug('メモを削除しました。画面を更新します。');
                    $_SESSION['msg_success'] = SUC08;
                    header('location:myMemo.php');
                }
            }
        } catch (Exceptiojn $e) {
            err_log('エラー発生'.$e->getMessage());
            $err_msg['common'] = MSG07;
        }
    }
}



debug('画面表示処理終了<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');


?>

<?php
// $edit_flg = (empty($dbFormData)) ? false : true;
// $edit_flgを使い、$dbFormDataがカラかどうかを見ている。falseなら新規作成、trueなら編集 
// $dbFormDataが空でなければtrue(編集)を表示させる
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
      margin: 1em 2em;
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
       
           <label class="category_id <?php if (!empty($err_msg['category_id'])) echo 'err'; ?>">
            リスト
           </label>
            <div class="select-wrap">
            <select class="select-cate" name="category_id" id="">
            <?php
              if (!empty($_GET['m_id'])) {
                  foreach ($dbCategory as $key => $val) {
            ?>
                <option value="<?php echo $val['id'] ?>" <?php if (getFormData('category_id') == $val['id']) {
                          echo 'selected';
                      } ?>>
                  <?php echo $val['name']; ?>
                </option>
              <?php
                  }
              }
                ?>

           <!-- カテゴリを指定して、メモを新規作成する場合 -->
            <?php
            if (!empty($_GET['c_id'])) {
                foreach ($dbCategory as $key => $val) {
                    ?>
                <option value="<?php echo $val['id'] ?>" <?php if ($c_id == $val['id']) {
                        echo 'selected';
                    } ?>>
                  <?php echo $val['name']; ?>
                </option>
              <?php
                }
            }
            ?>
            </select>
            </div>

            <?php
            // getFormDataの中身をみる
            $test = getFormData('category_id', false);
            // debug('getFormData(category_id)の中身：'.print_r($test, true));
            ?>
         
          <div class="area-msg">
            <?php
            if (!empty($err_msg['category_id'])) echo $err_msg['category_id'];
            ?>
          </div>

        <!-- タイトル -->
          <label class="memo-title  <?php if(!empty($err_msg['memotitle'])) echo "err"; ?>">タイトル </label>
          <input type="text" name="memotitle" value="<?php echo getFormData('name'); ?>">
          <div class="area-msg">
              <?php echo getErr_msg('memotitle'); ?>
            </div>
          

        <!-- メモ内容 -->
          <label class="memo-contents <?php if(!empty($err_msg['contents'])) echo "err"; ?>">メモ</label>
          <?php
          // メモの復号化の前準備
          $formData_contents = getFormData('contents');
          debug('$formData_contentsの中身：'.print_r($formData_contents, true));
          ?>
          <!-- メモの復号化を行う -->
          <textarea name="contents" id="memo-area" cols="30" rows="10"><?php if(!empty($formData_contents)) echo sanitize(decContents($formData_contents)); ?></textarea>

          <div class="area-msg">
              <?php echo getErr_msg('contents'); ?>
            </div>

          <div class="btn-container">
            
            <input type="submit" class="btn btn-mid btn-Edit" value="<?php echo (!$edit_flg) ? '新規作成' : '編集' ?>">
            <input type="submit" class="btn btn-mid btn-del" name="dele" value="削除する">
            
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