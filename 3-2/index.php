<?php
  // ステップ1
  $fruits = ["りんご" => 300, "みかん" => 150, "もも" => 500];
  $numbers = [3, 5 ,2];

  // ステップ2
  function goukei($tanka, $kosu){
    $ans = $tanka * $kosu;
    return $ans;
  }

  // ステップ3
  $i = 0;
  foreach ($fruits as $key => $value) {
    $price = goukei($value, $numbers[$i]);
    echo "${key}は, ${price}円です。";
    echo "<br>";
    ++$i;
  }
?>  