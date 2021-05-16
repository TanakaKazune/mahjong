<?php session_start(); ?>
<?php
 require_once('../head.php');
 require_once('../variable.php')
?>

<div class="login-input">
 <form action="login-output.php" method="post">
 ログインID<input type="text" name="id"><br>
 氏名      <input type="text" name="name"><br>
 パスワード<input type="password" name="password"><br>
 <input type="submit" value="ログイン">
 </form>
</div>

<?php require_once('../foot.php') ?>