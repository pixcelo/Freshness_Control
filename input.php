<?php  
    require('connect.php'); 
    
    // 入力値を取得
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $store = $_POST['store'];
    
    $stmt = $pdo->prepare('INSERT INTO items (name, quantity, date, store) VALUES (:name, :quantity, :date, :store)');

    // 挿入する値を配列に格納
    $params = array(':name' => $name, ':quantity' => $quantity, ':date' => $date, ':store' => $store);
    
    //挿入する値が入った変数をexecuteにセットしてSQLを実行
    $stmt->execute($params); 

    // リダイレクト
    header('Location:index.php');
    exit();

?>