<?php

function connect_to_db()
{
  // DB接続の設定
  $dbn = 'mysql:dbname=mini_kakeibo;charset=utf8;port=3306;host=localhost';
  $user = 'tmatch_user';
  $pwd = 'gogo4102';

  try {
    // ここでDB接続処理を実行する
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
    exit("db error:" . $e->getMessage());
  }
}

// ログイン状態のチェック関数 →毎回id再生成
function check_session_id()
{
  if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] != session_id()) {
    header('Location: index.php');
  } else {
    session_regenerate_id(true); // セッションidの再生成
    $_SESSION['session_id'] = session_id(); // セッション変数に格納
  }
}
