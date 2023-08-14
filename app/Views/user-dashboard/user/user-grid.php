<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <link rel="stylesheet" href="<?= base_url('/css/grid.css') ?>"/>
    <meta charset="utf-8">
</head>
<body>
<a class="btn-home" href="<?= base_url('/admin/home') ?>">
    <img src="<?= base_url('/icons/home-icon.png') ?>"/>
</a>
<h1 class="title-page">
    <?= lang('User.title') ?>
</h1>
<a class="btn-logout" href="<?= base_url('/UserLogin/logout') ?>">
    <img src="<?= base_url('/icons/off.png') ?>"/>
</a>
<div class="container">

    <?php if(!empty($message)) : ?>
        <div class="message-info">
            <?=$message?>
        </div>
    <?php endif;?>
    <form method="get" class="form-search">
        <input name="search" value="<?=empty($_GET['search']) ? '': $_GET['search']?>">
        <button><img src="<?=base_url('/icons/search.png')?>"/></button>
    </form>

    <a class="btn-create" href="<?=base_url('/admin/user/create')?>"><img src="<?=base_url('/icons/add.png')?>"/></a>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th><?= lang('User.tableHeaderName') ?></th>
            <th>E-mail</th>
            <th><?= lang('User.tableHeaderStatus') ?></th>
            <th><?= lang('User.tableHeaderAction') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($users)) :
            foreach ($users as $user) :
                ?>
                <tr>

                    <td><?= $user->id ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->status ?></td>
                    <td>
                        <a class="btn-action" href="<?=base_url("admin/user/show/{$user->id}")?>"><img src="<?=base_url('icons/eye.png')?>"/></a>
                        <a class="btn-action" href="<?=base_url("admin/user/edit/{$user->id}")?>"><img src="<?=base_url('icons/edit.png')?>"/></a>
                    </td>
                </tr>
            <?php
            endforeach;
        endif;
        ?>
        </tbody>
    </table>
    <?= $links ?>
</div>
<script src="<?=base_url('js/message.js')?>"></script>
</body>
</html>
