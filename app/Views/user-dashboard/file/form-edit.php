<?= $this->extend("layouts/layout-user") ?>

<?= $this->section("title") ?>
<?= lang('File.title') ?>
<?= $this->endSection("title") ?>
<?= $this->section('titlePage') ?>
<?= lang('File.title') ?>
<?= $this->endSection('titlePage') ?>
<?= $this->section("content") ?>
<fieldset class="form">
    <legend><?= lang('File.textEditFile') ?></legend>
    <form action="<?= base_url('/admin/file/update') ?>"
          method="post"
          enctype="multipart/form-data">
        <label for="file"><?= lang('File.fieldFile') ?></label>
        <input type="file"
               name="file"
               id="file"
               value="">
        <label for="name"><?= lang('File.fieldName') ?></label>
        <input type="text"
               name="name"
               id="name"
               value="<?= $file->name ?>">

        <input type="hidden"
               name="id"
               value="<?= $file->id ?>">
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
                        <?= $customer->id == $file->customer_id ? 'selected' : '' ?>
                    ><?= $customer->name ?>
                    </option>
                <?php
                endforeach;
            endif;
            ?>
        </select>
        <?= csrf_field() ?>
        <button class="button-send"><img src="<?= base_url('icons/update.png') ?>"/></button>
        <?= $this->include("layouts/components/form-message-erro") ?>
    </form>
</fieldset>
<?= $this->endSection("content") ?>
