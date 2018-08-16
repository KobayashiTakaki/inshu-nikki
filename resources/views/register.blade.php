<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>飲酒日記</title>
  </head>

  <body>
    <h1>REGISTER</h1>
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
  </body>

</html>
