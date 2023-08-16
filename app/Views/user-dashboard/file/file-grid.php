<?= $this->extend("layouts/layout") ?>

<?= $this->section("title") ?>
<?= lang('File.title') ?>
<?= $this->endSection("title") ?>
<?= $this->section('titlePage') ?>
<?= lang('File.title') ?>
<?= $this->endSection('titlePage') ?>
<?= $this->section("content") ?>

<div class="actions-bar">
    <form method="get"
          class="form-search">
        <input name="search"
               value="<?= empty($_GET['search']) ? '' : $_GET['search'] ?>">
        <button><img src="<?= base_url('/icons/search.png') ?>" alt=""/></button>
    </form>

    <a class="btn-create"
       href="<?= base_url('/admin/file/create') ?>"><img src="<?= base_url('/icons/add.png') ?>" alt=""/></a>
</div>

<div class="container-table">
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th><?= lang('File.tableHeaderName') ?></th>
            <th><?= lang('File.tableHeaderCustomer') ?></th>
            <th><?= lang('File.tableHeaderUser') ?></th>
            <th><?= lang('File.tableHeaderAction') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($files)) :
            foreach ($files as $file) :
                ?>
                <tr>

                    <td><?= $file->id ?></td>
                    <td><?= $file->name ?></td>
                    <td><?= $file->customer ?></td>
                    <td><?= $file->user ?></td>
                    <td>
                        <div class="table-action">
                            <a class="btn-action"
                               href="<?= base_url("/admin/file/show/{$file->id}") ?>"><img src="<?= base_url('icons/eye.png') ?>" alt=""/></a>
                            <a class="btn-action"
                               href="<?= base_url("/admin/file/edit/{$file->id}") ?>"><img src="<?= base_url('icons/edit.png') ?>" alt=""/></a>
                            <a class="btn-action"
                               href="<?= base_url("/admin/file/download/{$file->id}") ?>"><img src="<?= base_url('icons/download.png') ?>" alt=""/></a>
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
<?= $this->endSection("content") ?>
