<?php
include('functions.php');

$pdo = connect_to_db();

$sql = 'SELECT * FROM records';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
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
        <a href="index.php" style="text-decoration: none;color:black; " onmouseover="this.style.fontWeight='bolder'" onmouseout="this.style.fontWeight='lighter'">かけいぼ</a>
      </nav>
    </header>

    <div class=" row">
      <div class="col-12">

        <div class="table-responsive">
          <table class="table table-striped table-fixed">
            <thead>
              <tr>
                <th scope="col" class="col-3">日付</th>
                <th scope="col" class="col-3">項目</th>
                <th scope="col" class="col-2">収入</th>
                <th scope="col" class="col-2">支出</th>
                <th scope="col" class="col-2">操作</th>
              </tr>
            </thead>

            <tbody>

              <?php foreach ($result as $record) : ?>

                <tr>
                  <td class='col-3'><?= $record["date"] ?></td>
                  <td class='col-3'><?= $record["title"] ?></td>
                  <!-- 三項演算子 typeが0か1かで表示場所変える-->
                  <td class='col-2'><?= $record['type'] == 0 ? $record["amount"] : '' ?></td>
                  <td class='col-2'><?= $record['type'] == 1 ? $record["amount"] : '' ?></td>
                  <!-- /三項演算子 -->
                  <td class='col-1'><a href='editForm.php?id=<?= $record["id"] ?>' style='text-decoration: none; color: black; font-weight: 200;' onmouseover="this.style.fontWeight='500'" onmouseout="this.style.fontWeight='200'">edit</a></td>
                  <td class='col-1'><a href='delete.php?id=<?= $record["id"] ?>' style='text-decoration: none; color: black; font-weight: 200;' onmouseover="this.style.fontWeight='500'" onmouseout="this.style.fontWeight='200'">del</a></td>
                </tr>

              <?php endforeach ?>
              <a class="nav-link" href="./createForm.php"><span style="text-decoration: none;color:black; font-weight: 200; font-size: 20px;" onmouseover="this.style.fontWeight='500'" onmouseout="this.style.fontWeight='lighter'">add</span></a>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="./assets/js/app.js"></script>
</body>

</html>
