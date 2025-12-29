<!DOCTYPE html>
<html>
<head>
    <title>Login | RaporToko</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/style.css">
</head>
<body class="login-page">

<div class="login-card">

    <div class="login-header">
        <img src="<?= BASE_URL ?>/logo.jpeg" alt="Logo">
        <h2>RaporToko</h2>
        <p>Mamabi Kitchen</p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="error-box">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/auth/login">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
