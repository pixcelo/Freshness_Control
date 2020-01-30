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

  // ログインしていなけばログイン画面に飛ばす
} else {
  header('Location: login.php');
  exit();
}

?>
    
    <div class="l-contents">

      <article>
        <p><?php print h($user['name']); ?>さんでログイン中です。<span><a href="logout.php">ログアウトする</a></span></p>

       <!-- ログインユーザーの商品情報を表示 -->
        <?php
        $items = $pdo->prepare('SELECT * FROM items WHERE user_id=? ORDER BY date');
        $items->execute(array($_SESSION['user_id']));
        $item = $users->fetch();
        ?>

        <table>
          <tr>
            <th>品名</th>
            <th>数</th>
            <th>賞味期限</th>
            <th>店舗</th>
            <th>残り</th>
          </tr>
        <?php while ($item = $items->fetch()): ?>
        
        <?php
        // 賞味期限のタイムスタンプを取得
        $timestamp_limit = strtotime($item['date']);
        // 今日のタイムスタンプを取得
        $timestamp_today = strtotime('now');                  
        // 経過日を取得して小数点切り捨て (1日 = 60秒 x 60分 x 24時間)
        $interval =  floor(($timestamp_limit - $timestamp_today) / (60 * 60 * 24)); 

        // テーブルの中身を表示
        echo '<tr>'.'<td>'.$item['name'].'</td>';
        echo '<td>'.$item['quantity'].'</td>';
        echo '<td>'.$item['date'].'</td>';
        echo '<td>'.$item['store'].'</td>';
        // 残り45日以下ならアラートマークをつける
        if ($interval < 45 ) { 
          echo '<td>'.$interval.'日'.'<i class="fas fa-exclamation-triangle">'.'</td>'.'</tr>';
        } else { 
          echo '<td>'.$interval.'日'.'</td>'.'</tr>';
        };
        ?>

        <?php endwhile; ?>
        <?php echo '</tr>'.'</table>'; ?>
         
      </article>
    </div>
  </div>

</body>
</html>