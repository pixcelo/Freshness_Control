<?php  
    require('connect.php'); 
    require('function.php');
    
    // 入力値を取得
    $name = h($_POST['name']);
    $quantity = h($_POST['quantity']);
    $date = h($_POST['date']);
    $store = h($_POST['store']);
    $id = h($_POST['id']);
    
    $stmt = $pdo->prepare('UPDATE items SET name=:name, quantity=:quantity, date=:date, store=:store WHERE id=:id');

    // 挿入する値を配列に格納
    $params = array(':name' => $name, ':quantity' => $quantity, ':date' => $date, ':store' => $store, ':id' => $id);
    
    //挿入する値が入った変数をexecuteにセットしてSQLを実行
    $stmt->execute($params); 

    // リダイレクト
    header('Location:index.php');
    exit();

    // var_dump($params);

?>