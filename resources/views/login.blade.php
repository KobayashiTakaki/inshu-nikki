<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>飲酒日記</title>
  </head>

  <body>
    <h1>LOGIN</h1>

    <form action="login" method="post"　autocomplete="off">
      @csrf
      <input type="text" name="email" placeholder="email">
      <input type="submit" value="ログイン">
    </form>
  </body>
</html>
