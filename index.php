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
      <a class="contents-list">item list</a>

      <?php require('connect.php'); ?>

      <article>
        <table>
        <?php print('<tr>' . '<th>品名</th>' .'<th>数量</th>'.'<th>賞味期限</th>'.'<th>店舗</th>'.'<th>残り日数</th>'.'</tr>'); ?>
          <?php while ($item = $items->fetch()): ?>
            
            <?php        
            //指定日時
            date_default_timezone_set('Asia/Tokyo');
            $today = new Datetime('now');
            $limit = new Datetime($item['date']);
            $interval = $limit->diff($today);

            $expiration_date = $interval->format('%a日');
            ?>

            <?php print('<tr>'.'<td>'.$item['name'].'</td>'.'<td>'.$item['quantity'].'</td>'.'<td>'.$item['date'].'</td>'.'<td>'.$item['store'].'</td>'.'<td>'.$expiration_date.'</td>'.'</tr>'); ?>

         <?php endwhile; ?>
      </article>

    </div>

  </div>

  <footer>
      <p><small>&copy; Freshness</small></p>
  </footer>
  
</body>
</html>