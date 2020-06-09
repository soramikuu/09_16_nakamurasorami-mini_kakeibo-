<?php
//新しいレコードを追加するための処理
//処理の流れ
//ゴール:新しい処理が追加され、topに戻る
//1.画面で入力された値の取得
//2.PHPからMySQLへの接続
//3.SQL文を作成し、画面で入力された値をreocrdsテーブルに追加
//4.index.phpに画面遷移する

// var_dump($_POST);
// exit();
session_start();


if (
    !isset($_POST['title']) || $_POST['title'] == '' ||
    !isset($_POST['amount']) || $_POST['amount'] == '' || !isset($_POST['type']) || $_POST['type'] == '' ||
    !isset($_POST['date']) || $_POST['date'] == ''
) {
    exit('ParamError');
}

include("functions.php");

$date = $_POST['date'];
$title = $_POST['title'];
$amount = $_POST['amount'];
$type = $_POST['type'];
$user_id = $_SESSION["user_id"];

$pdo = connect_to_db();

$sql = 'INSERT INTO records(id, title, type, amount, date,created_at, updated_at, user_id) VALUES(NULL, :title, :type, :amount, :date, sysdate(), sysdate(), :user_id)';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':type', $type, PDO::PARAM_STR);
$stmt->bindValue(':amount', $amount, PDO::PARAM_STR);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header("Location:read.php");
    exit();
}
