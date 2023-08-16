<?= $this->extend("layouts/layout-user") ?>

<?= $this->section("title") ?>
<?= lang('User.title') ?>
<?= $this->endSection("title") ?>
<?= $this->section('titlePage') ?>
<?= lang('User.title') ?>
<?= $this->endSection('titlePage') ?>
<?= $this->section("content") ?>
<fieldset class="show-fieldset">
    <legend><?=lang('User.title')?></legend>
    <strong><?=lang('User.fieldName')?>: </strong><?=$user->name?><br>
    <strong>E-mail: </strong><?=$user->email?><br>
    <strong>Status: </strong><?=$user->status?><br>
    <strong><?=lang('User.fieldCreatedAt')?>: </strong><?=$user->getCreatedAt(getenv('app.defaultLocale'));?><br>
    <strong><?=lang('User.fieldUpdatedAt')?>: </strong><?=$user->getUpdatedAt(getenv('app.defaultLocale'));?><br>
</fieldset>
<?= $this->endSection("content") ?>
