<!Doctype html>
<html>
<head>
    <style>
        body {
            background: #6a4394;
        }

        .btn {
            width: 80%;
            height: 150px;
            background: #61cc6f;
            border-radius: 5px;
            margin: auto;
            margin-top: 10px;
            text-align: center;
            padding-top: 15px;
            font-size: 35px;
            color: white;
        }

        a{
            text-decoration: none!important;
        }

        .btn:hover {
            box-shadow: 0px 0px 10px 3px #fff;
        }

        .content {
            padding: 5px;
            width: 500px;
            margin: auto;
            margin-top: 150px;
        }

        .color1 {
            background: #9088ffcc
        }

        .color2 {
            background: #ef7d4d;
        }

    </style>
</head>
<body>
<div class="content">
    <a href="<?= base_url('UserLogin'); ?>">
        <div class="btn color1"><?=lang('Login.defaultTextUser')?> <br> <?=lang('Login.defaultClickHere')?></div>
    </a>
    <a href="<?= base_url('CustomerLogin'); ?>">
        <div class="btn color2"><?=lang('Login.defaultTextCustomer')?>  <br> <?=lang('Login.defaultClickHere')?></div>
    </a>
</div>


</body>
</html>
