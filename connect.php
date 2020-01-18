<?php

try {
      // ローカル接続
      $pdo = new PDO(
      'mysql:dbname=gvbfuqnk_freshness;host=localhost:3306;charset=utf8mb4',
      'gvbfuqnk_tetsu',
      '{OJ@FnDHnh!bB*q5Oj');
    

  // PDOのエラーレポートを表示
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  

} catch(PDOException $e) {
  echo 'DB接続エラー: ' . $e->getMessage();
  var_dump($e);
}
?>