<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$name_page?></title>
    <link href="<?= site_url('include/css/bootstrap.css') ?>" rel="stylesheet">
    <link href="<?= site_url('include/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= site_url('include/css/main.css') ?>" rel="stylesheet">
    <script src="<?= site_url('include/js/jquery-1.10.2.min.js') ?>"></script>
    <script src="<?= site_url('include/js/bootstrap.min.js') ?>"></script>
    <script src="<?= site_url('include/form_validation/dist/js/bootstrapValidator.min.js') ?>"></script>
    <link href="<?= site_url('include/form_validation/src/css/bootstrapValidator.css') ?>" rel="stylesheet">


</head>

<body>

<?php
$use = new class_loader();
$use->use_lib('site/sessions');
$session = new sessions();
if($session->get_login_admin()){
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?site_url('admin')?>">Admin <small>( Election system ) </small></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?=site_url('admin')?>">Home</a></li>
                <li><a href="<?=site_url('admin/election')?>">Election</a></li>
                <li><a href="<?=site_url('admin/college')?>">College</a></li>
                <li><a href="<?=site_url('admin/slider')?>">Slider</a></li>
                <li><a href="<?=site_url('admin/specialty')?>">Specialty</a></li>
                <li><a href="<?=site_url('admin/students')?>">Students</a></li>
                <li><a href="<?=site_url('admin/users')?>">Users</a></li>
                <li><a href="<?=site_url('admin/logout')?>">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
<?PHP } ?>

<?=$content?>
</body>
</html>
