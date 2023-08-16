<?php

use App\Libraries\Util;

?>
<?= $this->extend("layouts/layout") ?>
<?= $this->section("title") ?>
Home
<?= $this->endSection("title") ?>
<?= $this->section("content") ?>
<div class="actions-bar">
    <form method="get"
          class="form-search">
        <input name="search"
               value="<?= empty($_GET['search']) ? '' : $_GET['search'] ?>">
        <button><img src="<?= base_url('/icons/search.png') ?>"/></button>
    </form>
</div>
<div class="container-table">
    <table>
        <thead>
        <tr>

            <th>Nome</th>
            <th>Tipo</th>
            <th>Tamanho</th>
            <th>Data Criação</th>
            <th>Data Atualização</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($files)) :
            foreach ($files as $file) :
                $pathFile = WRITEPATH . "uploads/" . $file->file_location;
                if (file_exists($pathFile)) {
                    $fileRec = new \CodeIgniter\Files\File($pathFile);
                }

                ?>
                <tr>
                    <td><?= $file->name ?></td>
                    <td><?= $fileRec ? $fileRec->getExtension() : '' ?></td>
                    <td><?= $fileRec ? $fileRec->getSize('MB') : '' ?>(MB)</td>
                    <td><?= Util::formatDate(getenv('app.defaultLocale'), $file->created_at) ?></td>
                    <td><?= Util::formatDate(getenv('app.defaultLocale'), $file->updated_at) ?></td>
                    <td>
                        <div class="table-action">
                            <a class="btn-action"
                               href="<?= base_url("/customer/download/{$file->id}") ?>"><img src="<?= base_url('icons/download.png') ?>"/></a>
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

