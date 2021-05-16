<?php session_start(); ?>
<?php
 require_once('../head.php');
 require_once('../variable.php')
?>

<form action="" method="post">
 <table>
     <tr>
         <td>氏名</td>
         <td><input type="text" name="name"></td>
     </tr><br>
     <tr>
         <td>パスワード</td>
         <td><input type="password" name="password"></td>
     </tr><br>
 </table>
    <input type="submit" value="確定">
</form>

<?php require_once('../foot.php') ?>
