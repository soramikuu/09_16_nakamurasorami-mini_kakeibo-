<?php
// var_dump($_GET);
// exit();
session_start();
include('functions.php');
check_session_id();

// idの受け取り
$id = $_GET['id'];

// DB接続
$pdo = connect_to_db();

// データ取得SQL作成 id=（$_GETで受け取った$idの行のデータを全て取る)
$sql = 'SELECT * FROM records WHERE id=:id';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は指定のidのレコードを取得
  // fetch()関数でSQLで取得したレコードを取得できる
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>かけいぼ</title>
</head>

<body style="background-color: #FFFFF0;">

  <div class="container">
    <header class="my-5">
      <nav>
        <a href="read.php" style="text-decoration: none; color:black;">かけいぼ</a>
      </nav>
    </header>

    <form class="m-5" action="./update.php" method="POST">
      <div class="form-group">
        <label for="date">日付</label>
        <input type="datel" id="date" name="date" value="<?= $record["date"] ?>" class=" form-control">
      </div>
      <div class="form-group">
        <label for="title">タイトル</label>
        <input type="text" id="title" name="title" value="<?= $record["title"] ?>" class="form-control">
      </div>
      <div class="form-group">
        <label for="amount">金額</label>
        <input type="number" id="amount" name="amount" value="<?= $record["amount"] ?>" class="form-control">
      </div>
      <div class="form-group">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="type" id="income" value=0 <?= $record['type'] == 0 ? 'checked' : ''; ?>>
          <label class="form-check-label" for="income">収入</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="type" id="spending" value=1 <?= $record['type'] == 1 ? 'checked' : ''; ?>>
          <label class="form-check-label" for="spending">支出</label>
        </div>
      </div>
      <div class="form-group">
        <button>編集</button>
        <input type="hidden" name="id" value="<?= $record['id'] ?>">
      </div>
    </form>

  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="./assets/js/app.js"></script>
</body>

</html>
