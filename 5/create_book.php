<?php
// db_connect.phpの読み込み
require_once("db_connect.php");

// function.phpの読み込み
require_once("function.php");

// ログインしていなければ、login.phpにリダイレクト
check_user_logged_in();

// 提出ボタンが押された場合
if (isset($_POST["post"])) {
    // titleとcontentの入力チェック
    if (empty($_POST["title"])) {
        echo 'タイトルが未入力です。';
        echo $_POST["stock"];
    } elseif (empty($_POST["date"])) {
        echo '発売日が未入力です。';
    } elseif (empty($_POST["stock"])) {
        echo '在庫数が未入力です。';
    } else {
   
        // 入力したtitleとdateとstockを格納
        $title = $_POST["title"];
        $date = $_POST["date"];
        $stock = $_POST["stock"];

        // PDOのインスタンスを取得
        $pdo = connect();

        try {
            // SQL文の準備
            $sql = "INSERT INTO books(title, date, stock) values(:title, :date, :stock)";
            // プリペアドステートメントの準備
            $stmt = $pdo->prepare($sql);
            // タイトルをバインド
            $stmt->bindParam(':title', $title);
            // 発売日をバインド
            $stmt->bindParam(':date', $date);
            // 在庫数をバインド
            $stmt->bindParam(':stock', $stock);
            // 実行
            $stmt->execute();
            // main.phpにリダイレクト
            header("Location: main.php");
        } catch (PDOException $e) {
            // エラーメッセージの出力
            echo "?re";
            echo 'Error: ' . $e->getMessage();
            // 終了
            die();
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>本 登録画面</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="form-group">
    <h1>本 登録画面</h1>
    <br>
        <form method="POST" action="">
            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="タイトル">
                <br>
                <input type="date" name="date" class="form-control" placeholder="発売日">
                <br>
                <p>在庫数</p>
                <select name="stock" id="stock" class="form-control">
                    <option value="">選択してください</option>
                    <?php for($number=1; $number<=50; $number++) {?>
                        <option value="<?= $number ?>"><?= $number ?></option>;
                    <?php } ?>
                </select>
                <br>
                <input type="submit" class="btn btn-primary w-25" value="登録" class="form-control" name="post">
            </div>
        </form>
    </div>
</div>
<?php include('bootstrap.php'); ?>
</body>
</html>