<?php session_start(); ?>
<?php
 require_once('../head.php');
 require_once('../variable.php');
?>

<?php if(isset($_SESSION['user']['id'])): ?>
 <?php
  $sql = $pdo->prepare('select * from user_information where id=?');
  $sql->execute([$_SESSION['user']['id']]);
  foreach($sql as $row){
     echo 'userID  ',$row['id'];
     echo '<br>';
     echo '氏名  ',$row['name'];
     echo '<br>';
    }
 ?>
 <br>
 <p>上記のユーザーからログアウトしますか</p><br>
 <a href="logout-output.php">ログアウト</a>
<?php else: ?>
 <p>既にログアウトされています</p>
<?php endif ?>

<?php require_once('../foot.php') ?>