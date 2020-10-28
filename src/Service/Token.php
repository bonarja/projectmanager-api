<?php

namespace App\Service;

use \Firebase\JWT\JWT;

class Token
{
    public function __construct()
    {
    }
    public static function encode($data, $life = 60 * 60)
    {
        $time = time();
        $info = [];
        $info["iss"] = "bonarja.com";
        $info["exp"] = $time + $life;
        $info["aud"] = self::getUserIP();
        $info["data"] = $data;
        $jwt = JWT::encode($info, TokenRsa::privateKey(), 'RS256');
        return $jwt;
    }
    public static function decode($jwt)
    {
        $decoded = JWT::decode($jwt, TokenRsa::publickey(), array('RS256'));
        return (object) $decoded;
    }
    public static function getUserIP()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $remote  = $_SERVER['REMOTE_ADDR'];
        $ip = $remote;
        return $ip;
    }
}
