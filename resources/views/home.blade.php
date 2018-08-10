<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>飲酒日記</title>
  </head>

  <body>
    <h1>HOME</h1>
    <!--
    <h2>今月の飲酒量</h2>
    <p>ビール 5000ml</p>
    <p>(アルコール換算 250ml)</p>
    -->
    <form action="post" method="post">
      @csrf
      
      <select name="kind">
        <option value="beer">ビール</option>
        <option value="sake">日本酒</option>
        <option value="sake">焼酎</option>
      </select>
      <select name="how">
        <option value="glass">グラス</option>
        <option value="glass">ジョッキ</option>
        <option value="glass">水割り</option>
      </select>
      <input name="amount" id="amount" value="">杯
      <input type="submit">
    </form>

    <form action="register" method="post"　autocomplete="off">
      @csrf
      <label for="name">名前</label>
      <input name="name" id="name">
      <br>
      <label for="age">email</label>
      <input name="email" id="email">
      <br>
      <label for="age">パスワード</label>
      <input name="password" id="password" type="password">
      <br>
      <input type="submit" value="登録">
    </form>

    <a href="show">セッション</a>


  </body>

</html>
