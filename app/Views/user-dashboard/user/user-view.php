<!doctype html>
<html>
<head>
    <title>Home</title>

    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <link rel="stylesheet" href="<?=base_url('/css/show.css')?>" />
    <meta charset="utf-8">
</head>
<body>
<a class="btn-home" href="<?= base_url('/admin/home') ?>">
    <img src="<?= base_url('/icons/home-icon.png') ?>"/>
</a>
<h1 class="title-page">
    <?= lang('User.title') ?>
</h1>
<a class="btn-logout" href="<?= base_url('/UserLogin/logout') ?>">
    <img src="<?= base_url('/icons/off.png') ?>"/>
</a>
<fieldset>
    <legend><?=lang('User.title')?></legend>
    <strong><?=lang('User.fieldName')?>: </strong><?=$user->name?><br>
    <strong>E-mail: </strong><?=$user->email?><br>
    <strong>Status: </strong><?=$user->status?><br>
    <strong><?=lang('User.fieldCreatedAt')?>: </strong><?=$user->getCreatedAt(getenv('app.defaultLocale'));?><br>
    <strong><?=lang('User.fieldUpdatedAt')?>: </strong><?=$user->getUpdatedAt(getenv('app.defaultLocale'));?><br>
</fieldset>
</body>
</html>
