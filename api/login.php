<?php
require '../main/db.php';
require '../utils/request.php';
require '../utils/tool.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $token = generateToken();
        storeToken($user['id'],$token,86400);
        returnJson([
            "token" => $token,
        ]);
        exit();
    } else {
        returnJson(["message" => '登录失败，用户名或密码错误。'], 'error');
    }
}
?>