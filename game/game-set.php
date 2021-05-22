<?php session_start(); ?>
<?php
 require_once('../head.php');
 require_once('../variable.php');
?>

<?php switch($_REQUEST['command']): 
    //game.phpで得たデータにより表示内容を分岐 ?>
<?php case 'set': ?>
 <?php
  $sql = $pdo->prepare('select * from battle_management where id=?');
  $sql->execute([$_REQUEST['game-id']]);
  //リクエストした値をコンストラクタに代入し、データベースの情報を検索
  if(isset($_SESSION['user'])){
    foreach($sql as $row){
      $_SESSION['user'] = [
        'id' => $_SESSION['user']['id'],
        'name' => $_SESSION['user']['name'],
        'game' => $row['id']];
    }
  }else{
    foreach($sql as $row){
      $_SESSION['user'] = ['game' => $row['id']];
    }
  }
    //データベースから取得した値をセッションに代入
  $sql = $pdo->prepare('select battle_management.id as id, point_rate, tip_rate, people,
  user1.name as user1, user2.name as user2, user3.name as user3, user4.name as user4
  from battle_management 
  join user_information as user1 on battle_management.member1=user1.id
  join user_information as user2 on battle_management.member2=user2.id
  join user_information as user3 on battle_management.member3=user3.id
  left join user_information as user4 on battle_management.member4=user4.id
  where battle_management.id=?');
  $sql->execute([$_REQUEST['game-id']]);
  foreach($sql as $row){
    echo "ゲームid　",$row['id'];
    echo '<br>';
    echo "得点のレート　",$row['point_rate'];
    echo '<br>';
    echo "チップのレート　",$row['tip_rate'];
    echo '<br>';
    echo "参加するユーザー　",$row['user1'];
    echo "、",$row['user2'];
    echo "、",$row['user3'];
    if($row['people'] = 4){
        echo "、",$row['user4'];
    }
  }
 ?>
 <br><br>
 <a href="game.php">ゲーム開始</a>
<?php break ?>
<?php case 'create': ?>
 <?php
   if(!isset($_REQUEST['id4'])){
     $_REQUEST['id4'] = 'null';
   }
   $sql = $pdo->prepare('insert into battle_management values(null,?,?,?,?,?,?,?,?)');
   $sql->execute([$_REQUEST['date'],$_REQUEST['point-rate'],$_REQUEST['tip-rate'],$_REQUEST['people'],
   $_REQUEST['id1'],$_REQUEST['id2'],$_REQUEST['id3'],$_REQUEST['id4']]);

   $sql = $pdo->prepare('select battle_management.id as id, point_rate, tip_rate, people,
   user1.name as user1, user2.name as user2, user3.name as user3, user4.name as user4
   from battle_management
   join user_information as user1 on battle_management.member1=user1.id
   join user_information as user2 on battle_management.member2=user2.id
   join user_information as user3 on battle_management.member3=user3.id
   left join user_information as user4 on battle_management.member4=user4.id
   where play_date=? and point_rate=? and tip_rate=? and
   member1=? and member2=? and member3=? and member4=?');
   $sql->execute([$_REQUEST['date'],$_REQUEST['point-rate'],$_REQUEST['tip-rate'],
   $_REQUEST['id1'],$_REQUEST['id2'],$_REQUEST['id3'],$_REQUEST['id4']]);
   foreach($sql as $row){
    echo "ゲームid　",$row['id'];
    echo '<br>';
    echo "得点のレート　",$row['point_rate'];
    echo '<br>';
    echo "チップのレート　",$row['tip_rate'];
    echo '<br>';
    echo "参加するユーザー　",$row['user1'];
    echo "、",$row['user2'];
    echo "、",$row['user3'];
    if($row['people'] = 4){
        echo "、",$row['user4'];
    }

    if(isset($_SESSION['user'])){
      foreach($sql as $row){
        $_SESSION['user'] = [
          'id' => $_SESSION['user']['id'],
          'name' => $_SESSION['user']['name'],
          'game' => $row['id']];
      }
    }else{
      foreach($sql as $row){
        $_SESSION['user'] = ['game' => $row['id']];
      }
    }
   } 
 ?>
 <br>
 <a href="game.php">ゲーム開始</a>
<?php break ?>
<?php endswitch; ?>
<?php require_once('../foot.php') ?>