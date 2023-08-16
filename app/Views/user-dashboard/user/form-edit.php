<?= $this->extend("layouts/layout") ?>

<?= $this->section("title") ?>
<?= lang('User.title') ?>
<?= $this->endSection("title") ?>
<?= $this->section('titlePage') ?>
<?= lang('User.title') ?>
<?= $this->endSection('titlePage') ?>
<?= $this->section("content") ?>
<fieldset class="form">
    <legend><?= lang('User.textEditUser') ?></legend>
    <form action="<?= base_url('/admin/user') ?>"
          method="post">
        <input type="hidden"
               name="_method"
               value="PUT"/>
        <label for="name"><?= lang('User.fieldName') ?></label>
        <input type="text"
               name="name"
               id="name"
               value="<?= $user->name; ?>">
        <label for="email">E-mail</label>
        <input type="email"
               id="email"
               name="email"
               value="<?= $user->email; ?>">
        <label for="cemail"><?= lang('User.fieldConfEmail') ?></label>
        <input type="email"
               name="cemail"
               id="cemail"
               value="<?= $user->email ?>">
        <input type="hidden"
               name="id"
               value="<?= $user->id ?>">
        <?= csrf_field() ?>
        <button class="button-send"><img src="<?= base_url('icons/update.png') ?>"/></button>
        <?= $this->include("layouts/components/form-message-erro") ?>
    </form>
</fieldset>
<?= $this->endSection("content") ?>
