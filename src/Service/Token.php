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
        $info["iss"] = "bonarja.org";
        $info["exp"] = $time + $life;
        $info["aud"] = "bonarja.org";
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
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        return $ip;
    }
}
