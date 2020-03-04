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

?>
    
    <div class="l-contents">

      <article>
        <p><?php print h($user['name']); ?>さんでログイン中です。<span><a href="logout.php">ログアウトする</a></span></p>
        <table>
          <tr>
            <th>品名</th>
            <th>店舗</th>
            <th></th>
          </tr>
         
          <tr>
            <form action="" method="POST">
            <td><input type="text" name="name"></td>
            <td><input type="text" name="store"></td>
            <td><input class="c-btn"  type="submit" name="search" value="検索する"></td>
          </tr>
        </form>

        <?php
       
        // 検索機能
        if (isset($_POST['search'])) {
          $sql = "SELECT * FROM items ";
        }

        if (empty($_POST['name']) && empty($_POST['store'])) {
          $sql = "SELECT * FROM items ORDER BY date";
        }
          
        // 品名検索
        if (!empty($_POST['name'])) {
          $name = $_POST['name'];
          $sql .= "WHERE name LIKE '%{$name}%' ORDER BY date";
        }

        // 店舗検索
        if (!empty($_POST['store'])){
          $store = $_POST['store'];
          $sql .= "WHERE store LIKE '%{$store}%' ORDER BY date";
        }
      
        $items = $pdo->prepare($sql);

        // bind 与えられた変数や数値に型を指定してパラメータに入れる（SQLインジェクション対策）
        $users->bindValue(':name', $name, PDO::PARAM_STR);
        $users->bindValue(':store', $store, PDO::PARAM_STR);

        echo '<pre>';
        var_dump("SQL文：".$sql);
        echo '</pre>';
        
        $items->execute();
        ?>

        </table>

        <table id="test">
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
        $now = date('Y/m/d');
        $timestamp_today = strtotime($now);
        // 経過日を取得して小数点切り捨て (1日 = 60秒 x 60分 x 24時間)
        $interval =  floor(($timestamp_limit - $timestamp_today) / (60 * 60 * 24)); 


        // テーブルの中身を表示
        echo '<tr>'.'<td>'.$item['name'].'</td>';
        echo '<td>'.$item['quantity'].'</td>';
        echo '<td>'.$item['date'].'</td>';
        echo '<td>'.$item['store'].'</td>';
        // 残り45日以下ならアラートマークをつける
        if ($interval <= 45 ) { 
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
  
<script>
</script>
</body>
</html>