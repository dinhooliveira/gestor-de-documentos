<?= $this->extend("layouts/layout") ?>

<?= $this->section("title") ?>
<?= lang('Customer.title') ?>
<?= $this->endSection("title") ?>
<?= $this->section('titlePage') ?>
<?= lang('Customer.title') ?>
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
       href="<?= base_url('/admin/customer/create') ?>">
        <img src="<?= base_url('/icons/add.png') ?>"
             alt=""/></a>
</div>
<div class="container-table">
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th><?= lang('Customer.tableHeaderName') ?></th>
            <th>E-mail</th>
            <th><?= lang('Customer.tableHeaderAction') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($customers)) :
            foreach ($customers as $customer) :
                ?>
                <tr>

                    <td><?= $customer->id ?></td>
                    <td><?= $customer->name ?></td>
                    <td><?= $customer->email ?></td>
                    <td>
                        <div class="table-action">
                            <a class="btn-action"
                               href="<?= base_url("/admin/customer/show/{$customer->id}") ?>"><img src="<?= base_url('icons/eye.png') ?>"
                                                                                                   alt=""/></a>
                            <a class="btn-action"
                               href="<?= base_url("/admin/customer/edit/{$customer->id}") ?>"><img src="<?= base_url('icons/edit.png') ?>"
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
<?= $this->endSection("content") ?>

