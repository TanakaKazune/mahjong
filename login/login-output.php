<?php session_start(); ?>
<?php
 require_once('../head.php');
 require_once('../variable.php')
?>

<?php
unset($_SESSION['user']);

$sql = $pdo->prepare('select * from user_information where id=? and name=? and password=?');
$sql->execute([$_REQUEST['id'], $_REQUEST['name'], $_REQUEST['password']]);
//リクエストした値をコンストラクタに代入し、データベースの情報を検索

foreach($sql as $row){
   $_SESSION['user'] = [
       'id' => $row['id'],
       'name' => $row['name'],
       'password' => $row['password']
   ];
} //データベースから取得した値をセッションに代入

if(isset($_SESSION['user'])){
    echo 'ようこそ、', $_SESSION['user']['name'], 'さん';
}else{
    echo '入力した情報に誤りがあります。';
}//セッション配列の中身を確認して、動作が正常に行われたかを出力

?>

<?php require_once '../foot.php' ?>