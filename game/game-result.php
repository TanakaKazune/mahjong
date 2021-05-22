<?php session_start(); ?>
<?php
 require_once('../head.php');
 require_once('../variable.php');
?>

<?php
 $sql = $pdo->prepare('select * from battle_management where id=?');
 $sql->execute([$_SESSION['user']['game']]);
 
 foreach($sql as $row){
     //後にsqlで使用するために要素を変数に代入
     $point_rate = (int) $row['point_rate'];

     $tip_rate = (int) $row['tip_rate'];

     $people = $row['people'];

     $user1 = $row['member1'];
     $user2 = $row['member2'];
     $user3 = $row['member3'];
     if($row['people'] == 4){
        $user4 = $row['member4'];
     }

     $_REQUEST['score1'] = (int) $_REQUEST['score1'];
     $_REQUEST['tip1'] = (int) $_REQUEST['tip1'];
     $_REQUEST['score2'] = (int) $_REQUEST['score2'];
     $_REQUEST['tip2'] = (int) $_REQUEST['tip2'];
     $_REQUEST['score3'] = (int) $_REQUEST['score3'];
     $_REQUEST['tip3'] = (int) $_REQUEST['tip3'];
     if($row['people'] == 4){
        $_REQUEST['score4'] = (int) $_REQUEST['score4'];
        $_REQUEST['tip4'] = (int) $_REQUEST['tip4'];
     }
     //$moneyを計算するために型をint型に変換

     $money1 = ($_REQUEST['score1']* $point_rate)+($_REQUEST['tip1']*$tip_rate);
     $money2 = ($_REQUEST['score2']*$point_rate)+($_REQUEST['tip2']*$tip_rate);
     $money3 = ($_REQUEST['score3']*$point_rate)+($_REQUEST['tip3']*$tip_rate);
     if($row['people'] == 4){
        $money4 = ($_REQUEST['score4']*$point_rate)+($_REQUEST['tip4']*$tip_rate);
     }
    }

 $sql = $pdo->prepare('insert into result_management value(null,?,?,?,?,?,null,?)');
 $sql->execute([$user1,$_SESSION['user']['game'],$_REQUEST['score1'],$_REQUEST['tip1'],$money1,$people]);
 $sql->execute([$user2,$_SESSION['user']['game'],$_REQUEST['score2'],$_REQUEST['tip2'],$money2,$people]);
 $sql->execute([$user3,$_SESSION['user']['game'],$_REQUEST['score3'],$_REQUEST['tip3'],$money3,$people]);
 if($people == 4){
    $sql->execute([$user4,$_SESSION['user']['game'],$_REQUEST['score4'],$_REQUEST['tip4'],$money4,$people]);
 }

 $sql = $pdo->prepare('select user_information.name as user, score, tip, money
 from result_management
 join user_information on result_management.user_information_id=user_information.id
 where battle_management_id=?');
 $sql->execute([$_SESSION['user']['game']]);
?>
 <table>
     <tr>
         <td>氏名</td>
         <td>　得点</td>
         <td>　チップ</td>
         <td>　収支</td>
     </tr>
     <?php foreach($sql as $row): ?>
      <tr>
         <td><?php echo $row['user'] ?></td>
         <td>　<?php echo $row['score'] ?></td>
         <td>　<?php echo $row['tip'] ?>枚</td>
         <td>　<?php echo $row['money'] ?>円</td>
      </tr>
     <?php endforeach ?>
 </table>

 <?php unset($_SESSION['user']['game']) ?>

 <a href="game.php">トップに戻る</a>
<?php require_once('../foot.php') ?>