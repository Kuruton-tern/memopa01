 <!-- footer -->
  <footer id="footer">
  Copyright <a href="top.php">memopa</a>. All Rights Reserved.
  </footer>

  <!-- innnerHeightに関しての参考記事→ https://www.flatflag.nir87.com/height-1083 -->
  <!-- innerHeight = 要素＋padding(borderの内側)を取得 -->
  <!-- outerHeight = 要素＋padding+borderを取得 -->
  <!-- window ＝ 画面上に出てくる小さい画面のこと-->
  <script src ="js/vendor/jquery-3.4.1.min.js"></script>
  <script>
  $(function(){

    // フッターを最下部に固定
      var $ftr = $('#footer');
      if( window.innerHeight > $ftr.offset().top + $ftr.outerHeight() ){
          $ftr.attr({'style': 'position:fixed; top:' + (window.innerHeight - $ftr.outerHeight()) + 'px;' });
      }
      //メッセージ表示
      var $jsShowMsg = $('#js-show-msg');
      var msg = $jsShowMsg.text();
      if(msg.replace(/^[\s　]+|[\s　]+$/g, "").length){
        $jsShowMsg.slideToggle('slow');
        setTimeout(function(){ $jsShowMsg.slideToggle('slow'); }, 3000);
     }

     //画像ライブプレビュー
     var $dropArea = $('.area-drop');
     var $fileInput = $('.input-file');
     $dropArea.on('dragover', function(e){
       e.stopPropagation();
       e.preventDefault();
       $(this).css('border', '3px #ccc dashed');
     });
     $dropArea.on('dragleave', function(e){
       e.stopPropagation();
       e.preventDefault();
       $(this).css('border', 'none');
     });
     $fileInput.on('change', function(e){
       $dropArea.css('border', 'none');
       var file = this.files[0],                    //2. files配列にファイルが入っています
           $img = $(this).siblings('.prev-img'),    //3. jQueryのsiblingsメソッドで兄弟のimgを取得
           fileReader = new FileReader();           //4. ファイルを読み込むFileReaderオブジェクトを作り、「fileReader」の中に入れている。

      //5. 読み込みが完了した際のイベントハンドラ。imgのsrcにデータをセット
      fileReader.onload = function(event){
        // 読み込んだデータをimgの設定
        $img.attr('src', event.target.result).show();
      };

      //6. 画像読み込み
      fileReader.readAsDataURL(file); //readAsDataURLは画像を文字列として扱えるもので、imgタグのsrc属性に画像のパスを入れる代わりに画像自体を文字列にして入れてしまうことで表示させるもの。

     });

     // テキストエリアカウント
     var $countUp = $('#js-count'),
        $countView = $('#js-count-view');
    $countUp.on('keyup', function(e){
      $countView.html($(this).val().length);
    });

    //画像切り替え
    var $switchImgSubs = $('.js-switch-img-sub'),
        $switchImgMain = $('#js-switch-img-main');
    $switchImgSubs.on('click',function(e){
      $switchImgMain.attr('src',$(this).attr('src'));
    });
 });

</script>

</body>

</html>
