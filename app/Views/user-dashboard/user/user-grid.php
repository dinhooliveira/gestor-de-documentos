<?= $this->extend("layouts/layout-user") ?>

<?= $this->section("title") ?>
<?= lang('User.title') ?>
<?= $this->endSection("title") ?>
<?= $this->section('titlePage') ?>
<?= lang('User.title') ?>
<?= $this->endSection('titlePage') ?>
<?= $this->section("content") ?>

<div class="actions-bar">


<form method="get"
      class="form-search">
    <input name="search"
           value="<?= empty($_GET['search']) ? '' : $_GET['search'] ?>">
    <button><img src="<?= base_url('/icons/search.png') ?>"
                 alt=""/></button>
</form>

<a class="btn-create"
   href="<?= base_url('/admin/user/create') ?>"><img src="<?= base_url('/icons/add.png') ?>" alt=""/></a>
</div>
<div class="container-table">

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
                    <div class="table-action">
                    <a class="btn-action"
                       href="<?= base_url("admin/user/show/{$user->id}") ?>"><img src="<?= base_url('icons/eye.png') ?>"
                                                                                  alt=""/></a>
                    <a class="btn-action"
                       href="<?= base_url("admin/user/edit/{$user->id}") ?>"><img src="<?= base_url('icons/edit.png') ?>"
                                                                                  alt=""/></a>
                    </div>
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
<?= $this->endsection("content") ?>

