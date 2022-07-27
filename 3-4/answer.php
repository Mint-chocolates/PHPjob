<link rel="stylesheet" href="style.css">
<?php 
//[question.php]から送られてきた名前の変数、選択した回答、問題の答えの変数を作成
  $name = $_POST["name"];
  $answer1 = $_POST["answer1"];
  $answer2 = $_POST["answer2"];
  $answer3 = $_POST["answer3"];
  $correct1 = $_POST["correct1"];
  $correct2 = $_POST["correct2"];
  $correct3 = $_POST["correct3"];

//選択した回答と正解が一致していれば「正解！」、一致していなければ「残念・・・」と出力される処理を組んだ関数を作成する
  function is_correct($ans, $correct){
    if ($ans == $correct) {
      echo "正解！";
    } else {
      echo "残念・・・";
    } 
  }
?>

<p><?php echo $name; ?>さんの結果は・・・？</p>
<p>①の答え</p>
<!--作成した関数を呼び出して結果を表示-->
<p><?php is_correct($answer1, $correct1); ?></p>

<p>②の答え</p>
<!--作成した関数を呼び出して結果を表示-->
<p><?php is_correct($answer2, $correct2); ?></p>

<p>③の答え</p>
<!--作成した関数を呼び出して結果を表示-->
<p><?php is_correct($answer3, $correct3); ?></p>