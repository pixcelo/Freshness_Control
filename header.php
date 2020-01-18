<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="images/teapot.png">
  <title>Freshness</title>
</head>
<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="js/main.js" defer></script>
<body>
  
  <div class="l_wrapper">

    <div class="c-btn--hamburger">
      <i class="fas fa-bars header__icon"></i>
      <p>MENU</p>
    </div>

    <header class="l_header">
        <h1>KEEP FRESH</h1>
    </header>

    <div class="l_sidebar">
      <div class="l_sidebar__inner">
      <p>input form</p>
      <i class="fas fa-times-circle l_sidebar__icon"></i>
      </div>
        
          <form action="input.php" method="post">
            <input type="text" name="name" placeholder="品名" required>
            <input class="js-updown" type="number" name="quantity" placeholder="数" required>
            <input type="date" name="date" placeholder="賞味期限" required>
            <input type="text" name="store"  placeholder="店舗" required><br> 
            <button type="submit" class="c-btn c-btn--input">登録</button><br><br>
          </form>
          <a href="edit.php"><button type="submit" class="c-btn c-btn--update">更新</button></a><br><br>
          <a href="delete_form.php"><button type="submit" class="c-btn c-btn--delete">削除</button></a>
    </div>
    <div class="l_sidebar-bg"></div>