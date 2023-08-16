<?= $this->extend("layouts/layout-user") ?>
<?= $this->section("title") ?>
Home
<?= $this->endSection("title") ?>
<?= $this->section("content") ?>

<div class="menu">
    <a class="menu-button menu-button-user"
       href="<?= base_url('admin/user') ?>">
        <div class="title"><?= lang('Home.titleButtonUser') ?></div>
        <img src="<?= base_url('/icons/undraw_add_user_ipe3.svg') ?>"
             alt=""/>
    </a>
    <a class="menu-button menu-button-customer"
       href="<?= base_url('admin/customer') ?>">
        <div class="title"><?= lang('Home.titleButtonCustumer') ?></div>
        <img src="<?= base_url('/icons/undraw_detailed_analysis_xn7y.svg') ?>"
             alt=""/>
    </a>
    <a class="menu-button menu-button-file"
       href="<?= base_url('admin/file') ?>">
        <div class="title"><?= lang('Home.titleButtonFile') ?></div>
        <img src="<?= base_url('/icons/undraw_add_file2_gvbb.svg') ?>"
             alt=""/>
    </a>
</div>
<?= $this->endsection("content") ?>
