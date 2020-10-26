<?php

namespace App\Service;

class Auth
{

    public static function verify(UserManager $userManager = null, $roles = "*")
    {
        function Response($value)
        {
            header('Content-Type: application/json');
            print json_encode($value);
            die();
        }

        $headers = apache_request_headers();

        // return TokenRsa::publickey();


        if (!isset($headers['Authorization']))
            return Response(["error" => "Invalid credentials"]);

        $token = substr($headers['Authorization'], 7);


        if (!$token)
            return Response(["error" => "Invalid credentials"]);

        $decode = null;

        try {
            $decode = Token::decode($token);
        } catch (\Throwable $th) {
            return Response(["error" => "Invalid credentials"]);
        }

        if (!$decode || $decode->aud != Token::getUserIP())
            return Response(["error" => "Invalid credentials"]);

        if ($userManager) {
            return $userManager->findById($decode->data->id);
        }
    }
}
