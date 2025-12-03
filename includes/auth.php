<?php
require_once __DIR__.'/../classes/userManager.php';
$um = new UserManager(__DIR__.'/../data/users.json');

if (!isset($_COOKIE['userid'])) {
    header('Location: /index.php'); exit;
}

$userId = (int)$_COOKIE['userid'];
$user = $um->findUserById($userId);
if (!$user) {
    setcookie('userid', '', time()-3600, '/');
    header('Location: /index.php'); exit;
}
