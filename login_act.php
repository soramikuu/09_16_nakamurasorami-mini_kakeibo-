<?php
// var_dump($_POST);
// exit();

session_start();
// 外部ファイル読み込み
include('functions.php');

// DB接続します
$pdo = connect_to_db();

// データ受け取り
$user_id = $_POST['user_id'];
$password = $_POST['password'];

// データ取得SQL作成&実行
$sql = 'SELECT * FROM users_table
WHERE user_id=:user_id AND password=:password AND is_deleted=0';

// SQL実行時にエラーがある場合はエラーを表示して終了
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

// うまくいったらデータ（1レコード）を取得
$val = $stmt->fetch(PDO::FETCH_ASSOC);

// ユーザ情報が取得できない場合はメッセージを表示
if (!$val) {
  echo "<p>ログイン情報に誤りがあります．</p>";
  echo '<a href="todo_login.php">login</a>';
  exit();
} else {
  // ログインできたら情報をsession領域に保存して一覧ページへ移動
  $_SESSION = array(); // セッション変数を空にする
  $_SESSION["session_id"] = session_id(); //ランダムなセッションidをセット
  $_SESSION["is_admin"] = $val["is_admin"];
  $_SESSION["user_id"] = $val["user_id"];

  header("Location:read.php"); //一覧ページへ
  exit();
}
