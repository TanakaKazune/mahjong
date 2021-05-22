<?php session_start(); ?>
<?php
 require_once('../head.php');
 require_once('../variable.php');
?>

<?php
 $sql = $pdo->prepare('select play_date from battle_management where id=?');
 $sql->execute([$_REQUEST['game']]);
?>
<?php foreach($sql as $row): ?>
  <div class="result-date"><?php echo $row['play_date'] ?> の成績</div><br>
<?php endforeach ?>

<table>
     <tr>
         <?php
          $sql = $pdo->prepare('select user1.name as user1, user2.name as user2, user3.name as user3, user4.name as user4
           from battle_management
           join user_information as user1 on battle_management.member1=user1.id
           join user_information as user2 on battle_management.member2=user2.id
           join user_information as user3 on battle_management.member3=user3.id
           left join user_information as user4 on battle_management.member4=user4.id
           where battle_management.id=?');
          $sql->execute([$_REQUEST['game']]);
         ?>
         <?php foreach($sql as $row): ?>
          <td>半荘</td>
          <td>　<?php echo $row['user1'] ?></td>
          <td>　<?php echo $row['user2'] ?></td>
          <td>　<?php echo $row['user3'] ?></td>
          <?php if($row['people'] == 4): ?>
            <td>　<?php echo $row['user4'] ?></td>
          <?php endif ?>
         <?php endforeach ?> 
     </tr>
     <?php
      $count = 0;
      $sql = $pdo->prepare('select battle_result.id as id, member1_score, member2_score, member3_score, member4_score, people, game
      from battle_result
      join battle_management
      on battle_result.battle_management_id=battle_management.id
      where battle_management_id=?');
      $sql->execute([$_REQUEST['game']]);
     ?>
     <?php foreach($sql as $row): ?>
      <tr>
         <td><?php $count++;
               echo $count; ?></td>
         <td>　<?php echo $row['member1_score'] ?></td>
         <td>　<?php echo $row['member2_score'] ?></td>
         <td>　<?php echo $row['member3_score'] ?></td>
         <?php if($row['people'] == 4): ?>
             <td>　<?php echo $row['member4_score'] ?></td>
         <?php endif ?>
      </tr>
     <?php endforeach ?>
     <?php
      $sql = $pdo->prepare('select sum(nvl(member1_score,0)) as score1,sum(nvl(member2_score,0)) as score2,
      sum(nvl(member3_score,0)) as score3, sum(nvl(member4_score,0)) as score4, people
       from battle_result
       join battle_management
       on battle_result.battle_management_id=battle_management.id
       where battle_management_id=?');
      $sql->execute([$_REQUEST['game']]);
     ?>
     
     <tr>
         <?php foreach($sql as $row): ?>
                 <td>合計</td>
                 <td>　<?php echo $row['score1'] ?></td>
                 <td>　<?php echo $row['score2'] ?></td>
                 <td>　<?php echo $row['score3'] ?></td>
                 <?php if($row['people'] == 4): ?>
                  <td>　<?php echo $row['score4'] ?></td>
                 <?php endif ?>
         <?php endforeach ?>
     </tr>
 </table><br><br>

<?php
 $sql = $pdo->prepare('select user_information.name as user, score, tip, money
 from result_management
 join user_information on result_management.user_information_id=user_information.id
 where battle_management_id=?');
 $sql->execute([$_REQUEST['game']]);
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
 </table><br><br>

 <a href="result.php">戻る</a>

<?php require_once('../foot.php') ?>