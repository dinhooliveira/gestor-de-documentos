<?= $this->extend("layouts/layout-user") ?>

<?= $this->section("title") ?>
<?= lang('User.title') ?>
<?= $this->endSection("title") ?>
<?= $this->section('titlePage') ?>
<?= lang('User.title') ?>
<?= $this->endSection('titlePage') ?>
<?= $this->section("content") ?>

<fieldset class="form">
    <legend><?= lang('File.textNewFile') ?></legend>
    <form action="<?= base_url('/admin/file') ?>"
          method="post"
          enctype="multipart/form-data">
        <label for="file"><?= lang('File.fieldFile') ?></label>
        <input type="file"
               name="file"
               id="file"
               value="<?= old('file') ?>">
        <label for="name"><?= lang('File.fieldName') ?></label>
        <input type="text"
               id="name"
               name="name"
               value="<?= old('name') ?>">
        <label for="customer"><?= lang('File.fieldCustomer') ?></label>
        <select
                name="customer"
                id="customer"
        >
            <option value="">--</option>
            <?php
            if (!empty($customers)):
                foreach ($customers as $customer):
                    ?>
                    <option value="<?= $customer->id ?>"
                        <?= $customer->id == old('customer') ? 'selected' : '' ?>
                    ><?= $customer->name ?>
                    </option>
                <?php
                endforeach;
            endif;
            ?>
        </select>
        <?= csrf_field() ?>
        <button class="button-send"><img src="<?= base_url('icons/save.png') ?>"
                                         alt=""/></button>
        <?= $this->include("layouts/components/form-message-erro") ?>

    </form>
    <?= $this->endSection("content") ?>

