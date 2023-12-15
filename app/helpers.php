<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Phpml\Clustering\KMeans;


function calculateAverageRating(array $ratings)
{
    if (empty($ratings)) {
        return null; // Mengembalikan null jika array kosong
    }

    $totalRatings = array_sum($ratings);
    $totalItems = count($ratings);

    return round($totalRatings / $totalItems, 1);
}

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


function haversine($lat1, $lon1, $lat2, $lon2)
{
    $earth_radius = 6371; //dalam kilometer
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);

    $delta_lat = $lat2 - $lat1;
    $delta_lon = $lon2 - $lon1;

    $a = sin($delta_lat / 2) * sin($delta_lat / 2) + cos($lat1) * cos($lat2) * sin($delta_lon / 2) * sin($delta_lon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $earth_radius * $c;

    return $distance;
}
