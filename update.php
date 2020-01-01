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
    header('Location:index.php');
    exit();

    var_dump($params);

?>