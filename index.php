<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="images/teapot.png">
  <title>Freshness</title>
</head>
<script>


</script>
<body>
  
  <div class="wrapper">

    <header>
      <div class="logo-box">
        <img class="logo" src="images/teapot.png" alt="急須">
        <h1>Freshness Control</h1>
      </div>
    </header>
    
    <div class="sidebar">
      <div class="side-box">
        <p class="sidebar-p">input form</p>
          <form class="input_form" action="input.php" method="post">
            <input type="text" name="name" placeholder="品名">
            <input type="text" name="quantity" placeholder="数量">
            <input type="date" name="date" placeholder="賞味期限">
            <input type="text" name="store"  placeholder="店舗"><br>
            <button type="submit">登録</button>
          </form>
      </div>
    </div>
    
    <div class="contents">
    <a class="contents-list">list</a>
    
    <?php
      try {
        $pdo = new PDO(
          'mysql:dbname=test_freshness;host=localhost;charset=utf8mb4',
          'root',
          '');
  
        // PDOのエラーレポートを表示
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $items = $pdo->query('SELECT * FROM items ORDER BY date');

      
      } catch(PDOException $e) {
        echo 'DB接続エラー: ' . $e->getMessage();
        var_dump($e);
      }
    ?>

    <article>
      <?php while ($item = $items->fetch()): ?>
        <p class="item"><?php print('品名：' .$item['name']); ?></p>
        <p class="item"><?php print('数量：' .$item['quantity']); ?></p>
        <time class="item"><?php print('賞味期限：' .$item['date']); ?></time>
        <p class="item"><?php print('店舗：' .$item['store']); ?></p>
        <?php        
        //指定日時
        date_default_timezone_set('Asia/Tokyo');
        $today = new Datetime('now');
        $limit = new Datetime($item['date']);
        $interval = $limit->diff($today);

        echo $interval->format('残り%a日');
        ?>
        <br>
        <hr>
      <?php endwhile; ?>
    </article>

    </div>

    <footer>
      <p><small>&copy; Freshness</small></p>
    </footer>
    
    </div>
  
</body>
</html>