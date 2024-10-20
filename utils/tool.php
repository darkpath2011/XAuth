<?php
require '../main/redis.php';

function generateToken($length = 32) {
    return bin2hex(random_bytes($length));
}
function storeToken($userId, $token, $expiration) {
    global $client;

    $hash_key = $token;

    $client->hset($hash_key, 'token', $token);
    $client->hset($hash_key, 'user_id', $userId);

    $client->expire($hash_key, $expiration);
}
function getUidForredis($usertoken) {
    global $client;

    $hash_key = $usertoken;

    $userId = $client->hget($hash_key, 'user_id');

    return $userId ?: 1;
}
?>
