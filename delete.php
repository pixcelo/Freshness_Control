<?php  
    require('connect.php'); 
    
    // 入力値を取得
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $store = $_POST['store'];
    $id = $_POST['id'];
    
    $stmt = $pdo->prepare('DELETE FROM items WHERE id=:id');

    // 挿入する値を配列に格納
    $params = array(':id' => $id);
    
    //挿入する値が入った変数をexecuteにセットしてSQLを実行
    $stmt->execute($params); 

    // var_dump($name);
    // var_dump($quantity);
    // var_dump($date);
    // var_dump($store);
    // var_dump($id);

    // リダイレクト
    header('Location:index.php');
    exit();

?>