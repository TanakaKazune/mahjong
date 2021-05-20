<?php session_start(); ?>
<?php
 require_once('../head.php');
 require_once('../variable.php');
?>

<?php if(!isset($_SESSION['user']['id'])): ?>
 
 ログインして下さい

<?php else: ?>

 <div class="result-name"><?php echo $_SESSION['user']['name'] ?>さんの成績</div><br>

 <?php
  $sql = $pdo->prepare('select result_management.battle_management_id as id,
  sum(money) as sum_money, sum(score) as sum_score, sum(tip) as sum_tip, play_date
  from result_management join battle_management
  on result_management.battle_management_id=battle_management.id
  where result_management.user_information_id=?');
  $sql->execute([$_SESSION['user']['id']]);
 ?>

 <?php foreach($sql as $row): ?>
  <p>収支　<?php echo $row['sum_money'] ?>円</p>
  <p>得点　<?php echo $row['sum_score'] ?></p>
  <p>チップ　<?php echo $row['sum_tip'] ?>枚</p><br>
 <?php endforeach ?>

 <?php $sql->execute([$_SESSION['user']['id']]); ?>
 <p>過去の半荘</p>
 <form action="result-output.php" name="form1" method="post">
     <?php foreach($sql as $row): ?>
      <input type="hidden" name="game" value="<?php echo $row['id'] ?>">
      <a href="javascript:form1.submit()"><?php echo $row['play_date'] ?></a><br>
     <?php endforeach ?>
 </form>
<?php endif ?>
<?php require_once('../foot.php') ?>