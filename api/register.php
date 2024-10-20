<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../main/db.php';
    require '../utils/request.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        returnJson(["code" => "3"], 'error');
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $email, $password])) {
            returnJson(["code" => "1"], 'success');
        } else {
            returnJson(["code" => "2"], 'error');
        }
    } catch (PDOException $e) {
        returnJson(["message" => $e->getMessage()], 'error');
    }
}
?>
