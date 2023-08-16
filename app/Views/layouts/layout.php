<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->renderSection('title') ?>
    </title>
    <link rel="shortcut icon"
          type="image/png"
          href="/favicon.ico"/>

    <link rel="stylesheet"
          href="<?= base_url('/css/user-style.css') ?>"/>
    <?= $this->renderSection('head') ?>
</head>
<body>
<a class="btn-home"
   href="<?= base_url('/admin/home') ?>">
    <img src="<?= base_url('/icons/home-icon.png') ?>" alt=""/>
</a>
<h1 class="title-page">
    <?= $this->renderSection('titlePage') ?>
</h1>
<a class="btn-logout"
   href="<?= base_url('/UserLogin/logout') ?>">
    <img src="<?= base_url('/icons/off.png') ?>"
         alt=""/>
</a>

<div class="container">
    <?php if (!empty($message)) : ?>
        <div class="message-info">
            <?= $message ?>
        </div>
    <?php endif; ?>
    <?= $this->renderSection('content') ?>
</div>
<script src="<?= base_url('js/message.js') ?>"></script>
<?= $this->renderSection('scripts') ?>
</body>
</html>
