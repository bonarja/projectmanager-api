<?php

namespace App\Service;

class TokenRsa
{
    public static function privateKey()
    {
        $fp = fopen("../config/jwt/private.pem", "r");
        $priv_key = fread($fp, 8192);
        fclose($fp);
        return openssl_get_privatekey($priv_key, $_ENV['PASSPHRASE']);
    }

    public static function publickey()
    {
        $fp = fopen("../config/jwt/public.pem", "r");
        $pub_key = fread($fp, 8192);
        fclose($fp);
        return $pub_key;
    }
}
