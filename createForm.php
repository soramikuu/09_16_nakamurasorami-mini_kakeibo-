<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>かけいぼ</title>
</head>

<body style="background-color: #FFFFF0;">

  <div class="container">
    <header class="my-5">
      <nav>
        <a href="index.php" style="text-decoration: none; color:black;">かけいぼ</a>
      </nav>
    </header>

    <form class="m-5" action="./create.php" method="POST">
      <div class="form-group">
        <label for="date">日付</label>
        <input type="date" id="date" name="date" class="form-control">
      </div>
      <div class="form-group">
        <label for="title">タイトル</label>
        <input type="text" id="title" name="title" class="form-control">
      </div>
      <div class="form-group">
        <label for="amount">金額</label>
        <input type="number" id="amount" name="amount" class="form-control">
      </div>
      <div class="form-group">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="type" id="income" value="0" checked>
          <label class="form-check-label" for="income">収入</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="type" id="spending" value="1">
          <label class="form-check-label" for="spending">支出</label>
        </div>
      </div>
      <div class="form-group">
        <button type="submit">追加</button>

      </div>
    </form>

  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="./assets/js/app.js"></script>
</body>

</html>
