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
    <?= lang('Customer.title') ?>
</h1>
<a class="btn-logout" href="<?= base_url('/UserLogin/logout') ?>">
    <img src="<?= base_url('/icons/off.png') ?>"/>
</a>
<fieldset>
    <legend><?=lang('Customer.title')?></legend>
    <strong><?=lang('Customer.fieldName')?>: </strong><?=$customer->name?><br>
    <strong>E-mail : </strong><?=$customer->email?><br>
    <strong><?=lang('Customer.fieldCreatedAt')?>: </strong><?=$customer->getCreatedAt(getenv('app.defaultLocale'));?><br>
    <strong><?=lang('Customer.fieldUpdatedAt')?>: </strong><?=$customer->getUpdatedAt(getenv('app.defaultLocale'));?><br>
</fieldset>
</body>
</html>
