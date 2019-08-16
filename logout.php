<?php
// function.phpを読み込まなければ処理に入れない。
// debug()がなければ、function.phpなしでもいけdebug()は自作関数だから)

 require('function.php');
 
  debug('                  ');
  debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
  debug('「　ログアウト画面　」');
  debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
// debugLogStart();

// セッションを壊す
session_destroy();
debug('セッションIDを削除しました');

// トップ画面に遷移させる
header("Location:index.php");
?>