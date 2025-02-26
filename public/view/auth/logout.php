<?php
require_once __DIR__ . "/../../../vendor/autoload.php";
use Dimas\TodolistPhp\controllers\auth\AuthUser;

$logout = new AuthUser();
$logout->logout();
?>