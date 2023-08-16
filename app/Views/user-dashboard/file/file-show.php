<?= $this->extend("layouts/layout-user") ?>

<?= $this->section("title") ?>
<?= lang('File.title') ?>
<?= $this->endSection("title") ?>
<?= $this->section('titlePage') ?>
<?= lang('File.title') ?>
<?= $this->endSection('titlePage') ?>
<?= $this->section("content") ?>
<fieldset class="show">
    <legend><?= lang('File.title') ?></legend>
    <strong><?= lang('File.fieldName') ?>:</strong><?= $file->name; ?><br>
    <strong><?= lang('File.fieldCustomer') ?>: </strong><?= $file->customer()->name; ?><br>
    <strong><?= lang('File.fieldUser') ?>: </strong><?= $file->user()->name; ?><br>
    <strong><?= lang('File.fieldSize') ?> (MB): </strong><?= $fileRec->getSize('mb'); ?><br>
    <strong><?= lang('File.fieldType') ?> : </strong><?= $fileRec->getExtension(); ?><br>
    <strong><?= lang('File.fieldCreatedAt') ?> : </strong><?= $file->getCreatedAt(getenv('app.defaultLocale')); ?><br>
    <strong><?= lang('File.fieldUpdatedAt') ?> : </strong><?= $file->getUpdatedAt(getenv('app.defaultLocale')); ?><br>
    <strong><?= lang('File.totalUserHistory') ?> : </strong><?= count($file->userDownloadHistory()); ?><br>
    <strong><?= lang('File.totalCustomerHistory') ?> : </strong><?= count($file->customerDownloadHistory()); ?><br>
</fieldset>
<?= $this->endSection('content') ?>

