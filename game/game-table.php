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
          $sql->execute([$_SESSION['user']['game']]);
         ?>
         <?php foreach($sql as $row): ?>
          <td>半荘</td>
          <td><?php echo $row['user1'] ?></td>
          <td><?php echo $row['user2'] ?></td>
          <td><?php echo $row['user3'] ?></td>
          <?php if($row['people'] = 4): ?>
            <td><?php echo $row['user4'] ?></td>
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
      $sql->execute([$_SESSION['user']['game']]);
     ?>
     <?php foreach($sql as $row): ?>
      <tr>
         <td><?php $count++;
               echo $count; ?></td>
         <form action="game.php" method="post">
             <input type="hidden" name="command" value="update">
             <input type="hidden" name="line" value="<?php echo $row['game'] ?>">
             <td><input type="text" name="score1"
                  value="<?php echo $row['member1_score'] ?>"></td>
             <td><input type="text" name="score2"
                  value="<?php echo $row['member2_score'] ?>"></td>
             <td><input type="text" name="score3"
                  value="<?php echo $row['member3_score'] ?>"></td>
             <?php if($row['people'] = 4): ?>
                 <td><input type="text" name="score4"
                  value="<?php echo $row['member4_score'] ?>"></td>
             <?php else: ?>
                 <input type="hidden" name="score4" value="null">
             <?php endif ?>
             <td><input type="submit" value="更新"></td>
         </form>
         <form action="game.php">
             <input type="hidden" name="command" value="delete">
             <input type="hidden" name="line" value="<?php echo $row['game'] ?>">
             <td><input type="submit" value="削除"></td>
         </form>
      </tr>
     <?php endforeach ?>
     <tr>
         <form action="game.php" method="post">
             <input type="hidden" name="command" value="insert">
             <?php $count++; ?>
             <input type="hidden" name="line" value="<?php echo $count ?>">
             <td>new</td>
             <td><input type="text" name="score1"></td>
             <td><input type="text" name="score2"></td>
             <td><input type="text" name="score3"></td>
             <?php if($row['people'] = 4): ?>
              <td><input type="text" name="score4"></td>
             <?php endif ?>
             <td><input type="submit" value="追加"></td>
         </form>
     </tr>
     <?php
      $sql = $pdo->prepare('select sum(nvl(member1_score,0)) as score1,sum(nvl(member2_score,0)) as score2,
      sum(nvl(member3_score,0)) as score3, sum(nvl(member4_score,0)) as score4, people
       from battle_result
       join battle_management
       on battle_result.battle_management_id=battle_management.id
       where battle_management_id=?');
      $sql->execute([$_SESSION['user']['game']]);
     ?>
     <form action="" method="post">
         <tr>
             <?php foreach($sql as $row): ?>
                 <td>合計</td>
                 <td><input type="text" name="score1" value="<?php echo $row['score1'] ?>"></td>
                 <td><input type="text" name="score2" value="<?php echo $row['score2'] ?>"></td>
                 <td><input type="text" name="score3" value="<?php echo $row['score3'] ?>"></td>
                 <?php if($row['people'] = 4): ?>
                  <td><input type="text" name="score4" value="<?php echo $row['score4'] ?>"></td>
                 <?php endif ?>
             <?php endforeach ?>
         </tr>
         <tr>
             <td>チップ</td>
             <td><input type="text" name="tip1"></td>
             <td><input type="text" name="tip2"></td>
             <td><input type="text" name="tip3"></td>
             <?php if($row['people'] = 4): ?>
                <td><input type="text" name="tip4"></td>
             <?php endif ?>
         </tr>
         <tr><td><input type="submit" value="半荘データを確定"></td></tr>
     </form>
 </table>