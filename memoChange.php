<?php
$siteTitle = 'メモ変更画面';
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
    
      .form .btn-change {
        background: #5bbfea;
      }
    
      .form .btn-change:hover {
        background: #22A8E2;
      }
    </style>

    <!-- ヘッダー  -->
  <header>
    <div class="site-width">
      <h1><a href="index.html">memopa</a></h1>
      <nav id="top-nav">
        <ul>
          <li><a href="list.html">リストを作成</a></li>
          <li><a href="myMemo.html">マイメモ</a></li>
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

          <!-- タイトル -->
          <label class="memo-title">タイトル</label>
          <input type="text" name="name">

          <!-- メモ内容 -->
          <label class="memo-contents">メモ</label>
          <textarea name="contents" id="memo-contents" cols="30" rows="10"></textarea>

          <!-- リスト -->
          <label class="memo-title">リスト名</label>
          <input type="text" name="list">

          <div class="btn-container">
            <input type="submit" class="btn btn-mid btn-change" value="変更する">
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