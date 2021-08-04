<?php

namespace srag\Plugins\OnlyOffice\CryptoService;

require_once 'libs/composer/vendor/autoload.php';

class JwtService {

    public static function jwtEncode($payload, $key)
    {
        $header = [
            "alg" => "HS256",
            "typ" => "JWT"
        ];
        $encHeader = self::base64UrlEncode(json_encode($header));
        $encPayload = self::base64UrlEncode(json_encode($payload));
        $hash = self::base64UrlEncode(self::calculateHash($encHeader, $encPayload, $key));

        return "$encHeader.$encPayload.$hash";
    }

    public static function jwtDecode($token, $key)
    {

        $split = explode(".", $token);
        if (count($split) != 3) {
            return "";
        }

        $hash = self::base64UrlEncode(self::calculateHash($split[0], $split[1], $key));

        if (strcmp($hash, $split[2]) != 0) {
            return "";
        }
        return self::base64UrlDecode($split[1]);
    }

    protected static function calculateHash($encHeader, $encPayload, $key) :string
    {
        return hash_hmac("sha256", "$encHeader.$encPayload", $key, true);
    }

    protected static function base64UrlEncode($str) :string
    {
        return str_replace("/", "_", str_replace("+", "-", trim(base64_encode($str), "=")));
    }

    protected static function base64UrlDecode($payload) :string
    {
        $b64 = str_replace("_", "/", str_replace("-", "+", $payload));
        switch (strlen($b64) % 4) {
            case 2:
                $b64 = $b64 . "==";
                break;
            case 3:
                $b64 = $b64 . "=";
                break;
        }
        return base64_decode($b64);
    }
}
