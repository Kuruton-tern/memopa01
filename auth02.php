<?php

//==============================
//ログイン認証・自動ログアウト
//==============================
//ログインしている場合
if (!empty($_SESSION['login_date'])) {
    debug('ログイン済みユーザーです。');

    //現在日時が最終ログイン日時＋有効期限を超えていた場合
    if (($_SESSION['login_date'] + $_SESSION['login_limit']) < time()) {
        debug('ログイン有効期限オーバーです。');

        //セッションを削除する=ログアウトするということ。(必ずこの関数を使うこと！)
        session_destroy();
        //ログインページへ
        header("Location:login.php");
    } else {
        debug("ログイン有効期限以内です。");
        //最終ログイン日時を現在日時に更新
        $_SESSION['login_date'] = time();

        //現在実行中のスクリプトファイル名がLogin.phpの場合
        //$_SERVER['PHP_SELF']はドメインからのパスを返すため、今回だと「/my_webservice/login.php」がかえってくるので、　
        //さらにbasename関数を使うことでファイル名だけを取り出せる。
        //この処理をしないと無限ループすることになる。
        if (basename($_SERVER['PHP_SELF']) === 'login.php') {
            debug("マイページへ遷移します。");
            header("Location:myMemo.php");  //マイページへ
        }
    }
} else {  //セッション自体がなければ
    debug("未ログインユーザーです。");
    if (basename($_SERVER['PHP_SELF']) !== 'login.php') {
        //  if(basename($_SERVER['PHP_SELF']) === 'login.php'){ にすると、永遠にループしちゃう。

        header("Location:login.php"); //ログインページへ
    }
}

?>

<!--basename関数とは？  -->

