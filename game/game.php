<?php session_start(); ?>
<?php
 require_once('../head.php');
 require_once('../variable.php');
?>

<?php if(!isset($_SESSION['user']['game'])) :?>
 
  <?php require_once('game-form.php') ?>

<?php else: ?>
 
  <?php require_once('game-table.php') ?>

<?php endif; ?>
<?php require_once('../foot.php') ?>