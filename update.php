<?php
var_dump($_POST);

if (
    !isset($_POST['title']) || $_POST['title'] == '' ||
    !isset($_POST['amount']) || $_POST['amount'] == '' || !isset($_POST['type']) || $_POST['type'] == '' ||
    !isset($_POST['date']) || $_POST['date'] == ''
) {
    exit('ParamError');
}

include("functions.php");

// 送信データ受け取り
$id = $_POST['id'];
$date = $_POST['date'];
$title = $_POST['title'];
$amount = $_POST['amount'];
$type = $_POST['type'];


// DB接続
$pdo = connect_to_db();

// UPDATE文を作成&実行
$sql = "UPDATE records SET title=:title, type=:type, amount=:amount, date=:date, updated_at=sysdate() WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':amount', $amount, PDO::PARAM_INT);
$stmt->bindValue(':type', $type, PDO::PARAM_INT);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);

$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
    header("Location:index.php");
    exit();
}
