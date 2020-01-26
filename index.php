<?php 
session_start();
require('connect.php');
require('header.php');
require('function.php'); 

// ログインしているか確認
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 3600 > time()) {
  $_SESSION['time'] = time();

  $users = $pdo->prepare('SELECT * FROM users WHERE user_id=?');
  $users->execute(array($_SESSION['user_id']));
  $user = $users->fetch();
} else {
  header('Location: login.php');
  exit();
}

?>
    
    <div class="l-contents">

      <article>
        <p><?php print h($user['name']); ?>さんでログイン中です。<span><a href="logout.php">ログアウトする</a></span></p>
      <table class="c-table">
          <?php
          $items = $pdo->query('SELECT * FROM items ORDER BY date');
          print('<tr>' . '<th>品名</th>' .'<th>数</th>'.'<th>賞味期限</th>'.'<th>店舗</th>'.'<th>残り</th>'.'</tr>');
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

</body>
</html>