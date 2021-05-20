<?php session_start(); ?>
<?php
 require_once('../head.php');
 require_once('../variable.php');
?>

<?php
 unset($_SESSION['user']);
 echo 'ログアウトしました'
?>

<?php require_once('../foot.php') ?>