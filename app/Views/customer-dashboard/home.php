<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <link rel="stylesheet" href="<?= base_url('/css/grid.css') ?>" />
    <meta charset="utf-8">
</head>

<body>
<h1 class="title-page">
    <?= lang('File.title') ?>
</h1>
<a class="btn-logout" href="<?= base_url('/CustomerLogin/logout') ?>">
    <img src="<?= base_url('/icons/off.png') ?>" />
</a>
<div class="container">
    <?php if (!empty($message)) : ?>
        <div class="message-info">
            <?= $message ?>
        </div>
    <?php endif; ?>
    <form method="get" class="form-search">
        <input name="search" value="<?= empty($_GET['search']) ? '' : $_GET['search'] ?>">
        <button><img src="<?= base_url('/icons/search.png') ?>" /></button>
    </form>

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
                    <td><?= \App\Libraries\Util::formatDate(getenv('app.defaultLocale'), $file->created_at) ?></td>
                    <td><?= \App\Libraries\Util::formatDate(getenv('app.defaultLocale'), $file->updated_at) ?></td>
                    <td>
                        <a class="btn-action" href="<?= base_url("/customer/download/{$file->id}") ?>"><img src="<?= base_url('icons/download.png') ?>" /></a>
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
<script src="<?= base_url('js/message.js') ?>"></script>
</body>

</html>
