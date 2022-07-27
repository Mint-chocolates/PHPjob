<link rel="stylesheet" href="style.css">
<?php
//POST送信で送られてきた名前を受け取って変数を作成
  $name = $_POST["name"];

//①画像を参考に問題文の選択肢の配列を作成してください。
  $answers1 = ["OK" => 80, 22, 20, 21];
  $answers2 = ["PHP", "Python", "JAVA", "OK" => "HTML"];
  $answers3 = ["join", "OK" => "select", "insert", "update"];

//② ①で作成した、配列から正解の選択肢の変数を作成してください
  $correct1 = $answers1["OK"];
  $correct2 = $answers2["OK"];
  $correct3 = $answers3["OK"];
?>
<p>お疲れ様です<?php echo $name; ?>さん</p>

<!--フォームの作成 通信はPOST通信で-->
<form action="answer.php" method="post">
  <h2>①ネットワークのポート番号は何番？</h2>
  <!--③ 問題のradioボタンを「foreach」を使って作成する-->
  <?php 
    foreach ($answers1 as $answer) {
      echo "<input type='radio' name='answer1' value='${answer}'>${answer}";
    }
  ?>
    
  <h2>②Webページを作成するための言語は？</h2>
  <!--③ 問題のradioボタンを「foreach」を使って作成する-->
  <?php 
    foreach ($answers2 as $answer) {
      echo "<input type='radio' name='answer2' value='${answer}'>${answer}";
    }
  ?>

  <h2>③MySQLで情報を取得するためのコマンドは？</h2>
  <!--③ 問題のradioボタンを「foreach」を使って作成する-->
  <?php 
    foreach ($answers3 as $answer) {
      echo "<input type='radio' name='answer3' value='${answer}'>${answer}";
    }
  ?>

  <!--問題の正解の変数と名前の変数を[answer.php]に送る-->
  <p><input type="hidden" name="name" value="<?php echo $name; ?>"></p>
  <p><input type="hidden" name="correct1" value="<?php echo $correct1; ?>"></p>
  <p><input type="hidden" name="correct2" value="<?php echo $correct2; ?>"></p>
  <p><input type="hidden" name="correct3" value="<?php echo $correct3; ?>"></p>
  <p><input type="submit" value="回答する"></p>
    
</form>