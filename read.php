<?php
session_start();
include('functions.php');
check_session_id();

$pdo = connect_to_db();

//mySQLに変数を受け渡す
$sql1 = "SELECT * FROM records WHERE user_id = '" . $_SESSION['user_id'] . "' ";
$sql2 = "SELECT amount FROM records WHERE type = 0 AND user_id = '" . $_SESSION['user_id'] . "'";
$sql3 = "SELECT amount FROM records WHERE type = 1 AND user_id = '" . $_SESSION['user_id'] . "'";
// $sql4 = 'SELECT user_id FROM users_table';

// SQL準備&実行
$stmt1 = $pdo->prepare($sql1);
$stmt2 = $pdo->prepare($sql2);
$stmt3 = $pdo->prepare($sql3);
// $stmt4 = $pdo->prepare($sql4);
$status1 = $stmt1->execute();
$status2 = $stmt2->execute();
$status3 = $stmt3->execute();
// $status4 = $stmt4->execute();

if ($status1 == false || $status2 == false || $status3 == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error1 = $stmt1->errorInfo();
  echo json_encode(["error_msg" => "{$error1[2]}"]);
  $error2 = $stmt2->errorInfo();
  echo json_encode(["error_msg" => "{$error2[2]}"]);
  $error3 = $stmt3->errorInfo();
  echo json_encode(["error_msg" => "{$error3[2]}"]);
  // $error4 = $stmt4->errorInfo();
  // echo json_encode(["error_msg" => "{$error4[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
  $result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
  // $result4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
}

// var_dump($result);
// var_dump($result2);
// var_dump(array_sum(array_column($result2, 'amount')));
// var_dump($result4);
$t_income = array_sum(array_column($result2, 'amount'));
$t_spending = array_sum(array_column($result3, 'amount'));

// foreach ($result as $val) {
//   print array_sum($val);
// }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/style.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/css/theme.default.min.css">
  <title>かけいぼ</title>
</head>

<body style="background-color: #FFFFF0;">

  <div class="container">
    <header class="my-5">
      <nav style="display: flex;">
        <a href="read.php" style="text-decoration: none;color:black; " onmouseover="this.style.fontWeight='bolder'" onmouseout="this.style.fontWeight='lighter'">かけいぼ</a>
        <div style="margin: 0 0 0 auto;">
          <p>こんにちは、<?= $_SESSION['user_id'] ?>さん</p>
        </div>
        <div style="margin: 0 0 0 auto;">
          <a href="logout.php" style="text-decoration: none; color:black;font-weight: lighter; " onmouseover="this.style.fontWeight='bolder'" onmouseout="this.style.fontWeight='lighter'">logout</a>
        </div>
      </nav>
    </header>

    <a class="nav-link" href="./createForm.php"><span style="text-decoration: none;color:black; font-weight: 200; font-size: 20px;" onmouseover="this.style.fontWeight='500'" onmouseout="this.style.fontWeight='lighter'">add</span></a>

    <div class="row">
      <div class="col-12">

        <div class="table-responsive" id="kakeibo">
          <table class="table table-striped table-fixed" style="padding-bottom: 0px;">
            <thead>
              <tr>
                <th scope="col" class="col-3 sort" data-sort="date" style="cursor: pointer;" onmouseover="this.style.background='#FAF0E6'" onmouseout="this.style.background='#FFFFF0'">日付</th>
                <th scope="col" class="col-3">項目</th>
                <th scope="col" class="col-2">収入</th>
                <th scope="col" class="col-2 sort" data-sort="spending" style="cursor: pointer;" onmouseover="this.style.background='#FAF0E6'" onmouseout="this.style.background='#FFFFF0'">支出</th>
                <th scope="col" class="col-2">操作</th>
              </tr>
            </thead>

            <tbody class="list">

              <?php foreach ($result1 as $record) : ?>

                <tr>
                  <td class='col-3 date'><?= $record["date"] ?></td>
                  <td class='col-3'><?= $record["title"] ?></td>
                  <!-- 三項演算子 typeが0か1かで表示場所変える-->
                  <td class='col-2'><?= $record['type'] == 0 ? $record["amount"] : '' ?></td>
                  <td class='col-2 spending'><?= $record['type'] == 1 ? $record["amount"] : '' ?></td>
                  <!-- /三項演算子 -->
                  <td class='col-1'><a href='editForm.php?id=<?= $record["id"] ?>' style='text-decoration: none; color: black; font-weight: 200;' onmouseover="this.style.fontWeight='500'" onmouseout="this.style.fontWeight='200'">edit</a></td>
                  <td class='col-1'><a href='delete.php?id=<?= $record["id"] ?>' style='text-decoration: none; color: black; font-weight: 200;' onmouseover="this.style.fontWeight='500'" onmouseout="this.style.fontWeight='200'">del</a></td>
                </tr>
              <?php endforeach ?>
            </tbody>
            <tbody>
              <!-- 合計金額表示欄 -->
              <tr>
                <td class="col-3" style="font-weight: 500; ">計</td>
                <td class="col-3"></td>
                <td class="col-2" style='font-weight: 500;'><?= $t_income; ?></td>
                <td class="col-2" style='font-weight: 500;'><?= $t_spending; ?></td>
                <td class="col-2"></td>
              </tr>
              <tr>
                <td class="col-7"></td>
                <td class="col-5">
                  <p>今月の収支は
                    <span style="font-weight: 800; font-size: 24px; color: <?php echo $t_income - $t_spending < 0 ? 'red' : 'blue'; ?>;">
                      <?= $t_income - $t_spending; ?>
                    </span>
                    です！！
                  </p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
  <script>
    var options = {
      valueNames: ['date', 'spending']
    };
    var kakeiboList = new List('kakeibo', options);
  </script>
</body>

</html>
