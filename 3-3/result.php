
<?php
  $num = $_GET["num"];

  try {
    // 何も入力されなかったら例外を投げる
    if ($num == "") {
      throw new Exception("数字を入力してください。");
    }

    //抜き出す数字の位置をランダムに決める
    $rand_num = mt_rand(0, strlen($num) - 1);
    // 数字を抜き出す
    $ans = substr($num, $rand_num, 1);
  
    // 抜き出した数字で条件分岐
    switch ($ans) {
      case 0:
        $unsei = "凶";
        break;
      case 1:
      case 2:
      case 3:
        $unsei = "小吉";
        break;
      case 4:
      case 5:
      case 6:
        $unsei = "中吉";
        break; 
      case 7:
      case 8:
        $unsei = "吉";
        break;     
      default:
        $unsei = "大吉";
        break;
    }

    // 結果表示
    echo date("m月d日", time()). "の運勢は". $unsei. "です。";

  } catch (Exception $e) {
    echo  $e->getMessage();
  }
?>