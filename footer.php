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