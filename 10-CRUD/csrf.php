<?php
session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $headers = getallheaders();
    $headerToken = $headers['Csrf-Token'] ?? '';
    $postToken = $_POST['csrf_token'] ?? '';

    if ($headerToken !== $_SESSION['csrf_token'] && $postToken !== $_SESSION['csrf_token']) {
        echo json_encode(['error' => 'No CSRF token.']);
        exit;
    }
}
?>
