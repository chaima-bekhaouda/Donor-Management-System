<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="icon" href="favicon.ico">
</head>
<body>

<div class="search-container">
    <h2>Login</h2>
    <form id="login-form" action="login.php" method="post">
        <div class="criteria">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="criteria">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <?php if (isset($error)): ?>
            <p class="error" style="color: red; margin: 0; padding: 0;"><?= "Error: " . $error ?></p>
        <?php endif; ?>
        <div class="button-container">
            <button type="submit">Login</button>
        </div>
    </form>
</div>

</body>
</html>