<?php
require '../utils/request.php';
require '../utils/tool.php';
require '../main/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $token = $_GET['token'];
    $userId = getUidForredis($token);

    if ($userId != 1) {
        $stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        
        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($userInfo) {
            $username = $userInfo['username'];
            $email = $userInfo['email'];
            
            returnJson([
                "username" => $username,
                'email' => $email
            ]);
        } else {
            returnJson(["message" => "User not found."], 'error');
        }
    } else {
        returnJson(["message" => "Invalid token or user not found."], 'error');
    }
}
?>