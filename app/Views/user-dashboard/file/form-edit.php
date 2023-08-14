<!doctype html>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <link rel="stylesheet" href="<?= base_url('/css/form.css') ?>"/>
    <meta charset="utf-8">
</head>
<body>
<a class="btn-home" href="<?= base_url('/admin/home') ?>">
    <img src="<?= base_url('/icons/home-icon.png') ?>"/>
</a>

<a class="btn-logout" href="<?= base_url('/UserLogin/logout') ?>">
    <img src="<?= base_url('/icons/off.png') ?>"/>
</a>
<fieldset>
    <legend><?= lang('File.textEditFile') ?></legend>
    <form action="<?= base_url('/admin/file/update') ?>" method="post" enctype="multipart/form-data">
        <label><?= lang('File.fieldFile') ?></label>
        <input type="file" name="file" value="">
        <label><?= lang('File.fieldName') ?></label>
        <input type="text" name="name" value="<?= $file->name?>">
        <label><?= lang('File.fieldCustomer') ?></label>
        <input type="hidden" name="id" value="<?= $file->id ?>">
        <select type="text" name="customer" >
            <option value="">--</option>
            <?php
            if (!empty($customers)):
                foreach ($customers as $customer):
                    ?>
                    <option value="<?=$customer->id?>"
                        <?=$customer->id==$file->customer_id ? 'selected' : ''?>
                    ><?=$customer->name?>
                    </option>
                <?php
                endforeach;
            endif;
            ?>
        </select>
        <?= csrf_field() ?>
        <button class="button-send"><img src="<?=base_url('icons/update.png')?>"/></button>
        <?php
        if (!empty($erros)) {
            echo '<div class="message-error">';
            foreach ($erros as $erro) {
                echo $erro . "<br/>";
            }
            echo '</div>';
        }
        ?>

    </form>
</fieldset>
<script src="<?=base_url('js/message.js')?>"></script>
</body>
</html>
