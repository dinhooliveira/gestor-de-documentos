<?= $this->extend("layouts/layout") ?>

<?= $this->section("title") ?>
<?= lang('Customer.title') ?>
<?= $this->endSection("title") ?>
<?= $this->section('titlePage') ?>
<?= lang('Customer.title') ?>
<?= $this->endSection('titlePage') ?>
<?= $this->section("content") ?>
<fieldset class="form">
    <legend><?= lang('Customer.textEditCustomer') ?></legend>
    <form action="<?= base_url('/admin/customer') ?>"
          method="post">
        <input type="hidden"
               name="_method"
               value="PUT"/>
        <label for="name"><?= lang('Customer.fieldName') ?></label>
        <input type="text"
               name="name"
               id="name"
               value="<?= $customer->name; ?>">
        <label for="email">E-mail</label>
        <input type="email"
               name="email"
               id="email"
               value="<?= $customer->email; ?>">
        <label for="cemail"><?= lang('Customer.fieldConfEmail') ?></label>
        <input type="email"
               name="cemail"
               id="cemail"
               value="<?= $customer->email ?>">
        <input type="hidden"
               name="id"
               value="<?= $customer->id ?>">
        <?= csrf_field() ?>
        <button class="button-send"><img src="<?= base_url('icons/update.png') ?>"
                                         alt=""/></button>
        <?= $this->include("layouts/components/form-message-erro") ?>
    </form>
</fieldset>
<?= $this->endSection("content") ?>
