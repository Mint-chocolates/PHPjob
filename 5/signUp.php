<?php
// db_connect.phpの読み込み
require_once("db_connect.php");
// POSTで送られていれば処理実行
if (isset($_POST["signUp"])) {
// nameとpassword両方送られてきたら処理実行
    if (!empty($_POST["name"]) && !empty($_POST["password"])){
        // 入力したユーザIDとパスワードを格納// パスワードをハッシュ化
        $name = $_POST["name"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);;
    }else{
        echo "IDとPasswordを入力してください。";
        exit();
    }

// PDOのインスタンスを取得
    try {
            // SQL文の準備
            $sql = "INSERT INTO users(name, password) values(:name, :password)";
            // 関数db_connect()からPDOを取得する
            $pdo = connect();
            // プリペアドステートメントの作成
            $stmt = $pdo->prepare($sql);
            // 値をセット
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':password', $password);
            // 実行
            $stmt->execute();
            // 登録完了メッセージ出力
            echo '登録しました。';
        }catch (PDOException $e) {
            // エラーメッセージの出力
            echo 'Error: ' . $e->getMessage();
            // 終了
            die();
        }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ユーザー登録画面</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-group">
            <h1>ユーザー登録画面</h1>
            <form method="POST" action="">
                <br>
                <input type="text" class="form-control" name="name" placeholder="ユーザー名">
                <br>
                <input type="password" class="form-control" name="password" placeholder="パスワード"><br>
                <input type="submit" class="btn btn-primary w-25" value="新規登録" id="signUp" name="signUp">
            </form>
        </div>
    </div>
<?php include('bootstrap.php'); ?>
</body>
</html>