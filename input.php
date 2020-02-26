<?php  
    require('connect.php'); 
    require('function.php'); 
    
    // 入力値と登録ユーザーのidを取得
    $user_id = h($_POST['user_id']);
    $name = h($_POST['name']);
    $quantity = h($_POST['quantity']);
    $date = h($_POST['date']);
    $store = h($_POST['store']);

    try {

    $stmt = $pdo->prepare('INSERT INTO items (user_id, name, quantity, date, store) VALUES (:user_id, :name, :quantity, :date, :store)');

    // 挿入する値を配列に格納
    $params = array(':user_id' => $user_id, ':name' => $name, ':quantity' => $quantity, ':date' => $date, ':store' => $store);
    
    //挿入する値が入った変数をexecuteにセットしてSQLを実行
    $stmt->execute($params); 

    // リダイレクト
    header('Location:input_completed.php');
    exit();

    } catch(Exception $e) {

    echo 'DB挿入エラー: ' . $e->getMessage();
    var_dump($e);

    }

?>