<?= $this->extend("layouts/layout") ?>

<?= $this->section("title") ?>
<?= lang('Customer.title') ?>
<?= $this->endSection("title") ?>
<?= $this->section('titlePage') ?>
<?= lang('Customer.title') ?>
<?= $this->endSection('titlePage') ?>
<?= $this->section("content") ?>
<fieldset class="form">
    <legend><?= lang('Customer.textNewCustomer') ?></legend>
    <form action="<?= base_url('/admin/customer') ?>"
          method="post">
        <label><?= lang('Customer.fieldName') ?></label>
        <input type="text"
               name="name"
               value="<?= old('name') ?>">
        <label>E-mail</label>
        <input type="email"
               name="email"
               value="<?= old('email') ?>">
        <label><?= lang('Customer.fieldConfEmail') ?></label>
        <input type="email"
               name="cemail"
               value="<?= old('cemail') ?>">
        <?= csrf_field() ?>
        <button class="button-send"><img src="<?= base_url('icons/save.png') ?>"
                                         alt=""/></button>
        <?= $this->include("layouts/components/form-message-erro") ?>

    </form>
</fieldset>
<?= $this->endSection("content") ?>
