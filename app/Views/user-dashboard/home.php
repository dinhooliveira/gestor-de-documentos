<!doctype html>
<html>
	<head>
		<title>Home</title>

		<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
        <link rel="stylesheet" href="<?=base_url('/css/home.css')?>" />
        <meta charset="utf-8">
    </head>
	<body>
    <a class="btn-logout" href="<?= base_url('/UserLogin/logout') ?>">
        <img src="<?= base_url('/icons/off.png') ?>"/>
    </a>
     <div class="container">
         <a class="button user" href="<?=base_url('admin/user')?>">
             <div class="title"><?=lang('Home.titleButtonUser')?></div>
             <img src="<?=base_url('/icons/undraw_add_user_ipe3.svg')?>"/>
         </a>
         <a class="button customer" href="<?=base_url('admin/customer')?>">
             <div class="title"><?=lang('Home.titleButtonCustumer')?></div>
             <img src="<?=base_url('/icons/undraw_detailed_analysis_xn7y.svg')?>"/>
         </a>
         <a class="button file" href="<?=base_url('admin/file')?>">
             <div class="title"><?=lang('Home.titleButtonFile')?></div>
             <img src="<?=base_url('/icons/undraw_add_file2_gvbb.svg')?>"/>
         </a>


     </div>
	</body>
</html>
