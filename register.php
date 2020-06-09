<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザ登録画面</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body style="background-color: #FFFFF0;">
  <div class="container">
    <header class="my-5">
      <nav style="display: flex;">
        <div>
          <a href="read.php" style="text-decoration: none;color:black; " onmouseover="this.style.fontWeight='bolder'" onmouseout="this.style.fontWeight='lighter'">かけいぼ</a>
        </div>
        <div style="margin: 0 0 0 auto;">
          <a href="logout.php" style="text-decoration: none; color:black;font-weight: lighter; " onmouseover="this.style.fontWeight='bolder'" onmouseout="this.style.fontWeight='lighter'">logout</a>
        </div>
      </nav>
    </header>

    <form action="register_act.php" method="POST">
      <legend>ユーザ登録</legend>
      <div class="form-group">
        user_id: <input class="form-control" type="text" name="user_id">
      </div>
      <div class="form-group">
        password: <input class="form-control" type="text" name="password">
      </div>
      <div class="form-group">
        <button>Register</button>
      </div>
      <a href="index.php">or login</a>
    </form>

</body>

</html>
