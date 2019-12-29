<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="賞味期限を管理するためのアプリです。">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="images/teapot.png">
  <title>Freshness</title>
</head>
<body>
  
  <?php  
    require('connect.php'); 
    
    // 入力値を取得
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $store = $_POST['store'];
    $id = $_POST['id'];
    
    $stmt = $pdo->prepare('UPDATE items SET name=:name, quantity=:quantity, date=:date, store=:store WHERE id=:id');

    // 挿入する値を配列に格納
    $params = array(':name' => $name, ':quantity' => $quantity, ':date' => $date, ':store' => $store, ':id' => $id);
    
    //挿入する値が入った変数をexecuteにセットしてSQLを実行
    $stmt->execute($params); 

    // リダイレクト
    header('Location: index.php');
    exit();

    var_dump($params);

  ?>


</body>
</html>