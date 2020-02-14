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
    <legend><?=lang('User.textNewUser')?></legend>
    <form action="<?= base_url('admin/user') ?>" method="post">
        <label><?=lang('User.fieldName')?></label>
        <input type="text" name="name" value="<?= old('name') ?>">
        <label>E-mail</label>
        <input type="email" name="email" value="<?= old('email') ?>">
        <label><?=lang('User.fieldConfEmail')?></label>
        <input type="email" name="cemail" value="<?= old('cemail') ?>">
        <button class="button-send"><img src="<?=base_url('icons/save.png')?>"/></button>


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
