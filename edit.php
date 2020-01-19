<?php require('header.php'); ?>

    <div class="l_contents">

      <article>
      
          <?php
          $items = $pdo->query('SELECT * FROM items ORDER BY date');
          ?>
          <table class="c-table">
            <tr>
              <th>id</th>
              <th>品名</th>
              <th>数</th>
              <th>賞味期限</th>
              <th>店舗</th>
              <th></th>
              <th></th>
            </tr>
            <?php while ($item = $items->fetch()): ?>

              <?php        
                // タイムスタンプを取得
                $timestamp_limit = strtotime($item['date']);
                // 現在のタイムスタンプを取得
                $timestamp_today = strtotime('now');                  
                // 経過日を取得して小数点切り捨て (1日 = 60秒 x 60分 x 24時間)
                $interval =  floor(($timestamp_limit - $timestamp_today) / (60 * 60 * 24)); 
              ?>
              
              <form method="post" action="update.php">
              <tr>
                <td><?php if( !empty($item['id']) ){ print($item['id']); } ?></td>
                <td><input type="text" name="name" value="<?php if( !empty($item['name']) ){ print $item['name']; } ?>"></td>
                <td><input type="text" name="quantity" value="<?php if( !empty($item['quantity']) ){ print $item['quantity']; } ?>"></td>
                <td><input type="text" name="date" value="<?php if( !empty($item['date']) ){ print $item['date']; } ?>" ></td>
                <td><input type="text" name="store" value="<?php if( !empty($item['store']) ){ print $item['store']; } ?>" ></td>
                <td><a href="index.php"><button type="button" class="c-btn">取消</button></a></td>
                <td><button type="submit" class="c-btn c-btn--update">更新</button></td>
                <input type="hidden" name="id" value="<?php print($item['id']) ?>">
              </tr>
        </form>
      <?php endwhile; ?>
      </table>
      </article>
    </div>

  </div>
  
</body>
</html>