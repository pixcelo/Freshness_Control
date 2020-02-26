<?php session_start(); ?>

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
  
  <div class="l-wrapper">

    <header class="l-header">
      <h1 ckass="l-header__title"><a href="index.php">KEEP FRESH</a></h1>

      <ul class="l-header--menu">
        <li class="js-product-input">1.商品を登録する</li>
        <li><a href="edit.php">2.商品情報を修正する</a></li>
      </ul>
    </header>

    <div class="l-sidebar">
      <div class="l-sidebar__inner">
        <p>input form</p>
        <i class="fas fa-times-circle l-sidebar__icon"></i>
      </div>

        <form action="input.php" method="post">
          <input type="hidden" name="user_id" value="<?php print($_SESSION['user_id']) ?>">
          <input type="text" name="name" placeholder="品名" required>
          <input type="number" name="quantity" placeholder="数" required>
          <input type="date" name="date" placeholder="賞味期限" required>
          <input type="text" name="store"  placeholder="店舗" required><br> 
          <button type="submit" class="c-btn c-btn--input">登録</button><br><br>
        </form>
    </div>
  <div class="l-sidebar-bg"></div>

