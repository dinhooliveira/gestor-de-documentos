<!Doctype html>
<html>
<head>
    <style>
        html, body {
            margin: 0;
            background: 0;
            background: #6a4394;
        }


        .card-login {
            background: #fff;
            width: 300px;
            margin: auto;
            margin-top: 10%;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 7px 15px 5px #8a7796;
        }

        .card-login input, button {
            width: 100%;
            height: 35px;
            margin-bottom: 7px;
            text-underline: none;
            text-decoration: none;
        }

        .card-login-title {
            text-align: center;
            border-bottom: solid 1px;
            margin-bottom: 30px;
        }

        .message {
            color: red
        }


    </style>
</head>
<body>
<div class="card-login ">
    <div class="card-login-title">
        <h3>Forgot Password?<h3>
    </div>
    <form action="<?= !empty($urlChangePasswordAction) ? $urlChangePasswordAction : '' ?>" method="post">
        <label>Password</label>
        <input type="password" name="password"  required>
        <label>Conf. Password</label>
        <input type="password" name="cpassword" required>
        <?= csrf_field() ?>
        <button action="submit">Enviar</button>
        <div class="message">
            <?php
            if (!empty($erros)) {
                foreach ($erros as $erro) {
                    echo $erro . "<br/>";
                }
            }
            ?>
        </div>
    </form>
</div>


</body>
</html>
