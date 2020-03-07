<?php
    session_start();
    require('connect.php');
    require('header.php');
    require('function.php');

    // ログインしているか確認（セッション時間＝１時間）
    if (isset($_SESSION['user_id']) && $_SESSION['time'] + 3600 > time()) {
    $_SESSION['time'] = time();
    $users = $pdo->prepare('SELECT * FROM users WHERE user_id=?');
    $users->execute(array($_SESSION['user_id']));
    $user = $users->fetch();

    } else {
    // ログインしていなけばログイン画面に飛ばす
    header('Location: login.php');
    exit();
    }

    // フォームを送信した時にだけエラーチェックを走らせる
    if(!empty($_POST)) {
        if ($_POST['name'] === '') {
        $error['name'] = 'blank';
        }
        if ($_POST['quantity'] === '') {
        $error['quantity'] = 'blank';
        }
        if ($_POST['date'] === '') {
            $error['date'] = 'blank';
        }
        if ($_POST['store'] === '') {
            $error['store'] = 'blank';
        }
    }

    try {

        if($_POST['name'] != '' && $_POST['quantity'] != '' && $_POST['date'] != '' && $_POST['store'] != '') {

        $stmt = $pdo->prepare('INSERT INTO items (user_id, name, quantity, date, store) VALUES (:user_id, :name, :quantity, :date, :store)');

        // 名前付けされたプレースホルダを用いてプリペアドステートメントを実行
        $stmt->bindValue(':user_id', h($_POST['user_id']), PDO::PARAM_INT);
        $stmt->bindValue(':name', h($_POST['name']), PDO::PARAM_STR);
        $stmt->bindValue(':quantity', h($_POST['quantity']), PDO::PARAM_INT);
        $stmt->bindValue(':date', h($_POST['date']), PDO::PARAM_STR);
        $stmt->bindValue(':store', h($_POST['store']), PDO::PARAM_STR);
        $stmt->execute();
        
        header('Location:input_completed.php');
        exit();
      
        }
    

    } catch(Exception $e) {

    echo 'DB挿入エラー: ' . $e->getMessage();
    var_dump($e);

    }
?>

    <div>
      <div class="l-sidebar__inner">
        <p>入力フォーム</p>
      </div>
        <form action="" method="post">
            <input type="text" name="name" placeholder="品名" required>
            <?php if($error['name'] == 'blank'): ?>
            <p class="error">品名を入力してください。</p>
            <?php endif; ?>

            <input type="number" name="quantity" placeholder="数" required>
            <?php if($error['quantity'] == 'blank'): ?>
            <p class="error">数を入力してください。</p>
            <?php endif; ?>

            <input type="date" name="date" placeholder="賞味期限" required>
            <?php if($error['date'] == 'blank'): ?>
            <p class="error">賞味期限を入力してください。</p>
            <?php endif; ?>

            <input type="text" name="store"  placeholder="店舗" required>
            <?php if($error['store'] == 'blank'): ?>
            <p class="error">店舗を入力してください。</p>
            <?php endif; ?>
            <input type="submit" class="c-btn c-btn--input" value="登録"></input>
            <input type="hidden" name="user_id" value="<?php print($_SESSION['user_id']) ?>">
        </form>
    </div>

  </body>
</html>