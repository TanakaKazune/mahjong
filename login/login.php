<?php session_start(); ?>
<?php
 require_once('../head.php');
 require_once('../variable.php')
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
 <p>上記のユーザーにログイン中です。ログアウトしますか</p><br>
 <a href="../logout/logout-output.php">ログアウト</a>
<?php else: ?>
 <div class="login-input">
  <form action="login-output.php" method="post">
  ログインID<input type="text" name="id"><br>
  氏名      <input type="text" name="name"><br>
  パスワード<input type="password" name="password"><br>
  <input type="submit" value="ログイン">
  </form>
 </div>
<?php endif ?>

<?php require_once('../foot.php') ?>