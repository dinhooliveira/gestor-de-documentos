<html>
<head>
    <title>Login</title>

    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <link rel="stylesheet" href="<?= base_url('/css/login.css') ?>"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>

<div class="card-login">
    <div class="card-login-title"><h1>CUSTOMER LOGIN</h1></div>
    <form action="<?= base_url('CustomerLogin/login') ?>" method="post">
        <label>E-mail</label>
        <input type="text" name="email" value="<?= old('email') ?>" required>
        <label>Password</label>
        <input type="password" name="password" value="<?= old('password') ?>" required>
        <button>Login</button>
        <div class="message">
            <?= empty($message) ? '' : $message ?>
        </div>
    </form>
</div>

</body>
</html>
