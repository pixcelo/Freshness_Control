<?php  
    require('connect.php'); 
    require('function.php'); 
    
    // 入力値を取得
    $name = h($_POST['name']);
    $quantity = h($_POST['quantity']);
    $date = h($_POST['date']);
    $store = h($_POST['store']);
    
    $stmt = $pdo->prepare('INSERT INTO items (name, quantity, date, store) VALUES (:name, :quantity, :date, :store)');

    // 挿入する値を配列に格納
    $params = array(':name' => $name, ':quantity' => $quantity, ':date' => $date, ':store' => $store);
    
    //挿入する値が入った変数をexecuteにセットしてSQLを実行
    $stmt->execute($params); 

    // リダイレクト
    header('Location:index.php');
    exit();

?>