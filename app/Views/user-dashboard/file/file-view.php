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
    <?= lang('File.title') ?>
</h1>
<a class="btn-logout" href="<?= base_url('/UserLogin/logout') ?>">
    <img src="<?= base_url('/icons/off.png') ?>"/>
</a>
<fieldset>
    <legend><?= lang('File.title') ?></legend>
    <strong><?= lang('File.fieldName') ?>:</strong><?=$file->name;?><br>
    <strong><?= lang('File.fieldCustomer') ?>: </strong><?=$file->customer()->name;?><br>
    <strong><?= lang('File.fieldUser') ?>: </strong><?=$file->user()->name;?><br>
    <strong><?= lang('File.fieldSize') ?> (MB): </strong><?=$fileRec->getSize('mb');?><br>
    <strong><?= lang('File.fieldType') ?> : </strong><?=$fileRec->getExtension();?><br>
    <strong><?= lang('File.fieldCreatedAt') ?> : </strong><?=$file->getCreatedAt(getenv('app.defaultLocale'));?><br>
    <strong><?= lang('File.fieldUpdatedAt') ?> : </strong><?=$file->getUpdatedAt(getenv('app.defaultLocale'));?><br>
    <strong><?= lang('File.totalUserHistory') ?> : </strong><?=count($file->userDownloadHistory());?><br>
    <strong><?= lang('File.totalCustomerHistory') ?> : </strong><?=count($file->customerDownloadHistory());?><br>
</fieldset>
</body>
</html>
