<? php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=mahjong_date;charser=utf8','staff','password');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>麻雀成績管理サイト</title>
<link rel="stylesheet" href="stylesheet.css">
<body>

<?php require_once('main.php') ?>
