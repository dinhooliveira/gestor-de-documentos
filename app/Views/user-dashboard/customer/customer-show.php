<?= $this->extend("layouts/layout") ?>

<?= $this->section("title") ?>
<?= lang('Customer.title') ?>
<?= $this->endSection("title") ?>
<?= $this->section('titlePage') ?>
<?= lang('Customer.title') ?>
<?= $this->endSection('titlePage') ?>
<?= $this->section("content") ?>
<fieldset class="show-fieldset">
    <legend><?= lang('Customer.title') ?></legend>
    <strong><?= lang('Customer.fieldName') ?>: </strong><?= $customer->name ?><br>
    <strong>E-mail : </strong><?= $customer->email ?><br>
    <strong><?= lang('Customer.fieldCreatedAt') ?>
        : </strong><?= $customer->getCreatedAt(getenv('app.defaultLocale')); ?><br>
    <strong><?= lang('Customer.fieldUpdatedAt') ?>
        : </strong><?= $customer->getUpdatedAt(getenv('app.defaultLocale')); ?><br>
</fieldset>
<?= $this->endSection("content") ?>
