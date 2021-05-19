<form action="game-set.php" method="post">
     <input type="hidden" name="command" value="set">
      <!--ログインと新規作成のどちらの遷移をしたかの変数を渡す-->
     <div class="set-game">idを入力してゲームにログイン</div>
     <input type="text" name="game-id"><br>
     <input type="submit" value="ログイン"><br>
</form><br><br><br>
<!--既存のゲームデータを読み込むためのデータを取得-->  

  <form action="" method="post">
     <input type="hidden" name="command" value="create">
     <!--ログインと新規作成のどちらの遷移をしたかの変数を渡す-->
     <div class="new-game">新規ゲームの作成</div>
     
     <?php date_default_timezone_set('Japan'); ?>
     <input type="hidden" name=date value="<?php echo "date(y/m/d)" ?>">

     <p>得点のレート</p>
     <select name="point-rate">
         <option value="0">0</option>
         <option value="10">10</option>
         <option value="30">30</option>
         <option value="50">50</option>
         <option value="100">100</option>
     </select><br>

     <p>チップのレート</p>
     <input type="text" name="tip-rate"><br><br>

     <p>参加するユーザーの人数</p>
     <select name="people">
         <option value="3">3</option>
         <option value="4">4</option>
     </select><br><br>

     <p>参加するユーザーのuserID</p>
     <input type="text" name="id1"><br>
     <input type="text" name="id2"><br>
     <input type="text" name="id3"><br>
     <input type="text" name="id4"><br>
     <input type="submit" value="作成">
  </form>
  <!--新規ゲームを立ち上げるためのデータを取得-->