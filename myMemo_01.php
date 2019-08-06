<?php

    $key = "hogehoge";
    $str = "Hello World.";

    //暗号化
    $encrypt = openssl_encrypt($str, 'aes-256-ecb', $key);

    echo $encrypt;

    echo "<br>";

    //復号化
    $decrypt = openssl_decrypt($encrypt, 'aes-256-ecb', $key);

    echo $decrypt;

    echo "<br>";

    //methodの種類の確認
    print_r(openssl_get_cipher_methods());
