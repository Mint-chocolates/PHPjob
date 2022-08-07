<?php
// db_connect.phpの読み込み
require_once("db_connect.php");

// function.phpの読み込み
require_once("function.php");

// ログインしていなければ、login.phpにリダイレクト
check_user_logged_in();

// PDOのインスタンスを取得
$pdo = connect();

try {
    // SQL文の準備
    $sql = "select * from books order by title";
    // プリペアドステートメントの作成
    $stmt = $pdo->prepare($sql);
    // 実行
    $stmt->execute();
} catch (PDOException $e) {
    // エラーメッセージの出力 FILL_IN 
    echo 'Error: ' . $e->getMessage();
    // 終了 FILL_IN
    die();
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>メイン</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class=class="container">
    <h1>在庫一覧画面</h1>
    <br>
        <div class="row">
            <div class="col-md">
                <a class="btn btn-primary" href="create_book.php">新規登録</a>
                <a class="btn btn-secondary" href="logout.php">ログアウト</a>
            </div>
        </div>
        <br>
    <table  class="table table-bordered text-center">
        <tr class="table-secondary">
            <td>タイトル</td>
            <td>発売日</td>
            <td>在庫数</td>
            <td></td>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td>
                  <a class="btn btn-danger" href="delete_book.php?id=<?php echo $row['id']; ?>">削除</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<?php include('bootstrap.php'); ?>
</body>
</html>