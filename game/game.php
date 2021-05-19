<?php session_start(); ?>
<?php
 require_once('../head.php');
 require_once('../variable.php');
?>

<?php
 if(isset($_REQUEST['command'])){
     switch($_REQUEST['command']){
         case 'update':
            $sql = $pdo->prepare('update battle_result 
            set member1_score=?, member2_score=?, member3_score=?, member4_score=?
            where game=?');
            $sql->execute([$_REQUEST['score1'], $_REQUEST['score2'],$_REQUEST['score3'],
            $_REQUEST['score4'], $_REQUEST['line']]);
          break;
         case 'delete':
            $sql = $pdo->prepare('delete from battle_result where game=?');
            $sql->execute([$_REQUEST['line']]);
          break;
         case 'insert':
            $sql = $pdo->prepare('insert into battle_result values(null,?,?,?,?,?,?)');
            $sql->execute([$_SESSION['user']['game'], $_REQUEST['line'], $_REQUEST['score1'],
            $_REQUEST['score2'],$_REQUEST['score3'], $_REQUEST['score4']]);
          break;
        }
    }
?>

<?php if(!isset($_SESSION['user']['game'])) :?>
 
  <?php require_once('game-form.php') ?>

<?php else: ?>
 
  <?php require_once('game-table.php') ?>

<?php endif; ?>
<?php require_once('../foot.php') ?>