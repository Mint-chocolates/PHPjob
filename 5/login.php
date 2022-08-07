<?php
require_once('db_connect.php');
// セッション開始
session_start();

// $_POSTが空ではない場合
if (!empty($_POST)) {
    // ログイン名が入力されていない場合の処理
    if (empty($_POST["name"])) {
        echo "名前が未入力です。";
    }
    // パスワードが入力されていない場合の処理
    if (empty($_POST["pass"])) {
        echo "パスワードが未入力です。";
    }

    // 両方共入力されている場合
    if (!empty($_POST["name"]) && !empty($_POST["pass"])) {
        //ログイン名とパスワードのエスケープ処理
        $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
        $pass = htmlspecialchars($_POST['pass'], ENT_QUOTES);
        // ログイン処理開始
        $pdo = connect();
        try {
            //データベースアクセスの処理文章。ログイン名があるか判定
            $sql = "SELECT * FROM users WHERE name = :name";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            die();
        }

        // 結果が1行取得できたら
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // ハッシュ化されたパスワードを判定する定形関数のpassword_verify
            // 入力された値と引っ張ってきた値が同じか判定しています。
            if (password_verify($pass, $row['password'])) {
                echo $pass;
                echo $row['password'];
                // セッションに値を保存
                $_SESSION["user_id"] = $row['id'];
                $_SESSION["user_name"] = $row['name'];
                // main.phpにリダイレクト
                header("Location: main.php");
                exit;
            } else {
                // パスワードが違ってた時の処理
                echo "パスワードに誤りがあります。";
            }
        } else {
            //ログイン名がなかった時の処理
            echo "ユーザー名かパスワードに誤りがあります。";
        }
    }
}
?>
<!doctype html>
<html lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ログイン画面</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="container">
        <div class="row">
            <h1>ログイン画面</h1>
            <div class="col-md">
                <a class="btn btn-success" href="signUp.php">新規ユーザー登録</a> 
            </div>
        </div>
        <br>
        <div class="form-group">
            <form method="post" action="">
                <input type="text" class="form-control" name="name" placeholder="ユーザー名">
                <br>
                <input type="text" class="form-control" name="pass" placeholder="パスワード">
                <br>
                <input type="submit" class="btn btn-primary w-25" value="ログイン">
            </form>
        </div>
    </div>
    <?php include('bootstrap.php'); ?>
    </body>
</html>