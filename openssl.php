<?php
// require('function.php');

$enc_key  = "1234567890abcdefghijklmnopqrstuvwxyz";
    $m_contents_test = "あばばばばばばばばばばばばばばばば";

    //暗号化
    $encrypt = openssl_encrypt($m_contents_test, 'aes-256-ecb', $enc_key);

    echo $encrypt;
debug(print_r($encrypt,true));

    echo "<br>";

    //復号化
    $decrypt = openssl_decrypt($encrypt, 'aes-256-ecb', $enc_key);
debug(print_r($decrypt, true));

    echo $decrypt;

    echo "<br>";

    //methodの種類の確認
    // print_r(openssl_get_cipher_methods());

    echo "<br>";
    echo "<br>";

    function openssl_encrypt($m_contents_test, 'aes-256-ecb', $enc_key){
      $enc_key  = "1234567890abcdefghijklmnopqrstuvwxyz";
    $m_contents_test = "あばばばばばばばばばばばばばばばば";

    //暗号化
    $encrypt = openssl_encrypt($m_contents_test, 'aes-256-ecb', $enc_key);

    echo $encrypt;
debug(print_r($encrypt, true));

    }

    ?>
    <?php
    function encContents($m_contents){
      $enc_key  = "1234567890abcdefghijklmnopqrstuvwxyz";
      $method = 'aes-256-ecb';
      $m_contents_test = $m_contents;

      // 暗号化
      $enc_m_contents = openssl_encrypt($m_contents_test,$method,$enc_key);
      // 暗号化済みデータを返す
      return $enc_m_contents;
      debug($enc_m_contents);
    }
    ?>
