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
    $earthRadius = 6371; // Radius Bumi dalam kilometer

    // Menghitung perbedaan latitude dan longitude dalam radian
    $deltaLat = deg2rad($lat2 - $lat1);
    $deltaLon = deg2rad($lon2 - $lon1);

    // Menghitung rumus Haversine
    $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($deltaLon / 2) * sin($deltaLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // Menghitung jarak
    $distance = $earthRadius * $c;

    return $distance;
}
