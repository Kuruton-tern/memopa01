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
// $category = (!empty($_GET['c_id'])) ? $_GET['c_id'] : '';
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
// if(!empty($m_id) && empty($dbFormData)){
//   debug('GETパラメータの商品IDは違います。マイプロフへ遷移します');
//   header("Location:")
// }

// POST送信時処理
//==============================
// POST送信チェック
if (!empty($_POST)) {
  debug('POST送信があります。');
  debug('POST情報：'.print_r($_POST, true));

// 変数にユーザー情報を代入
    $m_c_id = $_POST['category_id'];  //$m_listだったもの
    $m_title = $_POST['memotitle'];
    $m_contents = $_POST['contents'];

    // 新規登録だったら（メモデータがなければ）
    if (empty($dbFormData)) {
        // 未入力チェック
        validRequired($m_title, 'memotitle');
        validRequired($m_contents, 'contents');
        validSelectChoice($_list, 'category_id');
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
            // DB接
            $dbh = dbConnect();
            // SQL文作成
            // 新規作成画面なら、INSERT。編集画面の場合は、UPDATE。
            if ($edit_flg) {
                debug('編集画面なのでDB更新です。');
                $sql = 'UPDATE memo SET category_id = :category_id, name = :name, contents = :contents, WHERE user_id = :u_id AND id = :m_id ';
                $data = array(':category_id' => $m_c_id, ':name' => $m_title, ':contents' => $m_contents, ':u_id' => $_SESSION['user_id'] , ':m_id' => $m_id);

                debug('SQLの中身：'.print_r($sql, true));
                debug('流し込みデータ：'.print_r($data, true));
            // クエリ実行
            $stmt = queryPost($dbh, $sql, $data);

            // クエリ成功の場合
            if ($stmt) {
                $_SESSION['msg_success'] = SUC04;
                debug('マイページへ遷移します。');
                header("location:myMemo.php"); //マイページへ
             }


            } else {
                debug('新規作成画面なのでDB登録です。');
                $sql = 'INSERT INTO memo (category_id, name, contents, user_id, create_date) VALUES (:category_id, :name, :contents, :u_id, :date)';
                $data = array(':category_id' => $m_c_id, ':name' => $m_title, ':contents' => $m_contents, ':u_id' => $_SESSION['user_id'], ':date' => date('Y-m-d H:i:s'));
            
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


              }

        } catch (Exceptiojn $e) {
            err_log('エラー発生'.$e->getMessage());
            $err_msg['common'] = MSG07;
        }
    }
}


debug('画面表示処理終了<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');


?>

<!-- $edit_flgを使い、$dbFormDataがカラかどうかを見ている。falseなら新規作成、trueなら編集 -->
<?php
// $dbFormDataが空でなければtrue(編集)を表示させる
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
       
           <label class="category_id <?php if (!empty($err_msg['category_id'])) echo 'err'; ?>">
            リスト
           </label>
            <div class="select-wrap">
            <select class="select-cate" name="category_id" id="">
            <!-- 新規作成の場合 -->
              <option value=" <?php if (getFormData('category_id') == 0) {
                                echo 'selected';
                              } ?>">
                              選択してください </option>

            <!-- メモを編集する場合 -->
              <?php
              foreach ($dbCategory as $key => $val) {
                ?>
                <option value="<?php echo $val['id'] ?>" <?php if (getFormData('category_id') == $val['id']) {
                                                            echo 'selected';
                                                          } ?>>
                  <?php echo $val['name']; ?>
                </option>
              <?php
            }
            ?>

           <!-- カテゴリを指定して、メモを新規作成する場合 -->
            <?php
              foreach ($dbCategory as $key => $val) {
                  ?>
                <option value="<?php echo $val['id'] ?>" <?php if ($c_id == $val['id']) {
                      echo 'selected';
                  } ?>>
                  <?php echo $val['name']; ?>
                </option>
              <?php
              }
            ?>
            </select>
            </div>

            <?php
            // getFormDataの中身をみる
$test = getFormData('category_id', false);
debug('getFormData(category_id)の中身：'.print_r($test, true));

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
          <textarea name="contents" id="memo-area" cols="30" rows="10"><?php echo getFormData('contents'); ?></textarea>
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