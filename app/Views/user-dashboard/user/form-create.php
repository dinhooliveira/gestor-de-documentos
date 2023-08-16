<?= $this->extend("layouts/layout") ?>

<?= $this->section("title") ?>
<?= lang('User.title') ?>
<?= $this->endSection("title") ?>
<?= $this->section('titlePage') ?>
<?= lang('User.title') ?>
<?= $this->endSection('titlePage') ?>
<?= $this->section("content") ?>
<fieldset class="form">
    <legend><?= lang('User.textNewUser') ?></legend>
    <form action="<?= base_url('admin/user') ?>"
          method="post">
        <label><?= lang('User.fieldName') ?></label>
        <input type="text"
               name="name"
               value="<?= old('name') ?>">
        <label>E-mail</label>
        <input type="email"
               name="email"
               value="<?= old('email') ?>">
        <label><?= lang('User.fieldConfEmail') ?></label>
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
