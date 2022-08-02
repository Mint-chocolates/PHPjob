<?php
require_once("getData.php");

$data = new getData();
$user = $data -> getUserData();
$posts = $data -> getPostData();

function getCategory($num){
  if ($num == 1) {
    return "食事";
  } elseif ($num == 2) {
    return "旅行";
  } else {
    return "その他";
  } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="haeder_logo"><img src="logo.png" alt=""></div>
    <div>
      <div class="haeder_greet">ようこそ<?php echo $user["last_name"].$user["first_name"] ?>さん</div>
      <div class="haeder_time">最終ログイン日:<?php echo $user["last_login"] ?></div>
    </div>
  </header>
  <main>
    <table border='1'>
      <tr>
        <th>記事ID</th>
        <th>タイトル</th>
        <th>カテゴリ</th>
        <th>本文</th>
        <th>投稿日</th>
      </tr>
      <?php
      while ($row = $posts->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo getCategory($row['category_no']); ?></td>
        <td><?php echo $row['comment']; ?></td>
        <td><?php echo $row['created']; ?></td>
      </tr>
      <?php
      }
      ?>
    </table>
  </main>
  <footer>
    Y&ampI group.ink
  </footer>
</body>
</html>