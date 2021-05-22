<?php session_start(); ?>
<?php
 require_once('../head.php');
 require_once('../variable.php')
?>

<?php
 $sql = $pdo->prepare('select * from user_information where name=? and password=?');
 $sql->execute([$_REQUEST['name'],$_REQUEST['password']]);
if(empty($sql->fetchAll())){
 $sql = $pdo->prepare('insert into user_information values(null,?,?)');
 $sql->execute([$_REQUEST['name'],$_REQUEST['password']]);
 echo 'user情報を登録しました。';
 echo '<br>';echo '<br>';
 }
 $sql = $pdo->prepare('select * from user_information where name=? and password=?');
 $sql->execute([$_REQUEST['name'],$_REQUEST['password']]);
 foreach($sql as $row){
     echo 'userID  ',$row['id'];
     echo '<br>';
     echo '氏名  ',$row['name'];
     echo '<br>';
     echo 'パスワード  ',$row['password'];
     echo '<br>';echo '<br>';
  }
?>

<a href="../login/login.php">ログイン画面へ</a>

<?php require_once('../foot.php') ?>