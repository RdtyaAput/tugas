<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" a href="style.css">
</head>
<body>
    <div class="container">
        <form action="proses.php" method="POST">
        <h1>LOGIN</h1>
        <div class="input-group">
            <label for="username">username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="text" id="password" name="password" required>
        </div>
        <button type="submit" name="login">LOGIN</button>
        </form>
    </div>
</body>
</html>