<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
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
            <input type="text" name="name" placeholder="品名" required>
            <input type="text" name="quantity" placeholder="数量" required>
            <input type="date" name="date" placeholder="賞味期限" required>
            <input type="text" name="store"  placeholder="店舗" required><br>
            <button type="submit" class="btn btn-input">登録</button><br><br>
          </form>

          <a href="edit.php"><button type="submit" class="btn btn-edit">編集</button></a><br><br>
          <a href="delete_form.php"><button type="submit" class="btn btn-delete">削除</button></a>
      </div>
    </div>
    
    <div class="contents">
      <a class="contents-list">item list</a>

      <article>
        <table>

          <?php
          require('connect.php'); 

          $items = $pdo->query('SELECT * FROM items ORDER BY date');
          print('<tr>' . '<th>品名</th>' .'<th>数量</th>'.'<th>賞味期限</th>'.'<th>店舗</th>'.'<th>残り日数</th>'.'</tr>');
          ?>

          <?php while ($item = $items->fetch()): ?>
          
            <?php        
            // Datetime関数のやり方は調査中
            // date_default_timezone_set('Asia/Tokyo');
            // $today = new Datetime('now');
            // $limit = new Datetime($item['date']);
            // $interval = $limit->diff($today);
            // $expiration_date = $interval->format('%a日');

            // タイムスタンプを取得
            $timestamp_limit = strtotime($item['date']);
            // 現在のタイムスタンプを取得
            $timestamp_today = strtotime('now');                  
            // 経過日を取得して小数点切り捨て (1日 = 60秒 x 60分 x 24時間)
            $interval =  floor(($timestamp_limit - $timestamp_today) / (60 * 60 * 24)); 
            // var_dump($timestamp_today);
            if ($interval < 45 ) {
      
            print('<tr>'.'<td>'.$item['name'].'</td>'.'<td>'.$item['quantity'].'</td>'.'<td>'.$item['date'].'</td>'.'<td>'.$item['store'].'</td>'.'<td>'.$interval.'日'.'<i class="fas fa-exclamation-triangle"></i>'.'</td>'.'</tr>'); 
          } else {

            print('<tr>'.'<td>'.$item['name'].'</td>'.'<td>'.$item['quantity'].'</td>'.'<td>'.$item['date'].'</td>'.'<td>'.$item['store'].'</td>'.'<td>'.$interval.'日'.'</td>'.'</tr>'); 
          };
            
            ?>

          <?php endwhile; ?>

        </table>
      </article>

    </div>

  </div>

  <footer>
      <!-- <p><small>&copy; Freshness</small></p> -->
  </footer>
  
</body>
</html>