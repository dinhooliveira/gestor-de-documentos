<!doctype html>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <link rel="stylesheet" href="<?= base_url('/css/form.css') ?>"/>
    <meta charset="utf-8">
</head>
<body>
<a class="btn-home" href="<?= base_url('/admin/home') ?>">
    <img src="<?= base_url('/icons/home-icon.png') ?>"/>
</a>

<a class="btn-logout" href="<?= base_url('/UserLogin/logout') ?>">
    <img src="<?= base_url('/icons/off.png') ?>"/>
</a>
<fieldset>
    <legend><?= lang('User.textEditUser') ?></legend>
    <form action="<?= base_url('/admin/user') ?>" method="post">
        <input type="hidden" name="_method" value="PUT" />
        <label><?= lang('User.fieldName') ?></label>
        <input type="text" name="name" value="<?= $user->name; ?>">
        <label>E-mail</label>
        <input type="email" name="email" value="<?= $user->email; ?>">
        <label><?= lang('User.fieldConfEmail') ?></label>
        <input type="email" name="cemail" value="<?= $user->email ?>">
        <input type="hidden" name="id" value="<?= $user->id ?>">
        <button class="button-send"><img src="<?=base_url('icons/update.png')?>"/></button>
        <?php
        if (!empty($erros)) {
            echo '<div class="message-error">';
            foreach ($erros as $erro) {
                echo $erro . "<br/>";
            }
            echo '</div>';
        }
        ?>

    </form>
</fieldset>
<script src="<?=base_url('js/message.js')?>"></script>
</body>
</html>
