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
            <button type="submit">登録</button><br><br>
            
          </form>

          
      </div>
    </div>
    
    <div class="contents">
      <a class="contents-list">item list</a>

      

      <article>
        <table>
          <?php
          require('connect.php'); 

          $items = $pdo->query('SELECT * FROM items ORDER BY date');
  
          ?>

          <?php while ($item = $items->fetch()): ?>
          
            <?php        
            //指定日時
            date_default_timezone_set('Asia/Tokyo');
            $today = new Datetime('now');
            $limit = new Datetime($item['date']);
            $interval = $limit->diff($today);
            $expiration_date = $interval->format('%a日');
            
          
            ?>
            
              <table>
                <tr>
                  <th>id</th>
                  <th>品名</th>
                  <th>数量</th>
                  <th>賞味期限</th>
                  <th>店舗</th>
                  <th>残り日数</th>
                </tr>
                <form method="post" action="update.php">
                <tr>
                  <td><?php if( !empty($item['id']) ){ print($item['id']); } ?></td>
                  <td><input type="text" name="name" value="<?php if( !empty($item['name']) ){ print($item['name']); } ?>" ></td>
                  <td><input type="text" name="quantity" value="<?php if( !empty($item['quantity']) ){ print($item['quantity']); } ?>" ></td>
                  <td><input type="text" name="date" value="<?php if( !empty($item['date']) ){ print($item['date']); } ?>" ></td>
                  <td><input type="text" name="store" value="<?php if( !empty($item['store']) ){ print($item['store']); } ?>" ></td>
                  <td><?php print($expiration_date); ?></td>
                </tr>
                
              </table>
            <a href="index.php"><button type="button">キャンセル</button></a>
            <input type="hidden" name="id" value="<?php print($item['id']) ?>">
            <button type="submit">更新</button>
            </form>
          <?php endwhile; ?>
      </article>
    </div>

  </div>

  <footer>
      <!-- <p><small>&copy; Freshness</small></p> -->
  </footer>
  
</body>
</html>