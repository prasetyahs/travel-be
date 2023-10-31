<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function encodeToken($credentials)
{
    $token = JWT::encode($credentials, env("JWT_SECRET"), 'HS256');
    return $token;
}
function decodeToken($token)
{
    try {
        if (!$token) {
            return false;
        }
        $decoded = JWT::decode($token, new Key(env("JWT_SECRET"), 'HS256'));
        if ($decoded) {
            return true;
        }
        return false;
    } catch (Exception $e) {
        return false;
    }
}


function haversine($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371)
{
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    return $angle * $earthRadius;
}