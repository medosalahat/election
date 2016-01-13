<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?= site_url('include/ico/favicon.png') ?>">
    <title>Wise Election - <?= $name_page ?></title>
    <link href="<?= site_url('include/css/bootstrap.css') ?>" rel="stylesheet">
    <link href="<?= site_url('include/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= site_url('include/css/main.css') ?>" rel="stylesheet">
    <script src="<?= site_url('include/js/jquery-1.10.2.min.js') ?>"></script>
    <script src="<?= site_url('include/js/bootstrap.min.js') ?>"></script>
    <script src="<?= site_url('include/form_validation/dist/js/bootstrapValidator.min.js') ?>"></script>
    <link href="<?= site_url('include/form_validation/src/css/bootstrapValidator.css') ?>" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
        $(document).ready(function () {
        $('#login_btn_s').click(function(){
            $('#login_modal').modal('show');
        });
        });
    </script>
</head>

<body>
<?PHP
$use = new class_loader();
$use->use_lib('site/slider');
$use->use_lib('table/tpl_slider');
$slider = new slider();
$tpl = new tpl_slider();
$use->use_lib('site/sessions');
$first = 1;
$two = 1;
$counter=1;
$data =$slider->find_slider();
$sessions = new sessions();
?>
<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= site_url() ?>">
                <img src="<?= site_url('include/img/logo.png') ?>"/>
                ELECTION SYSTEM
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= site_url() ?>">HOME</a></li>
                <?PHP if ($sessions->get_login()) {  ?><li><a href="<?=site_url('site/elect') ?>">ELECT</a></li><?PHP } ?>
                <li><a href="<?= site_url('site/about') ?>">ABOUT</a></li>
                <?PHP if (!$sessions->get_login()) {  ?><li><a id="login_btn_s">LOGIN</a></li><?PHP } ?>
                <?PHP if ($sessions->get_login()) {  ?><li><a href="<?= site_url('site/logout') ?>">LOGOUT</a></li><?PHP } ?>
                <li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-map-marker"></i></a>
                </li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->

    <ol class="carousel-indicators">
        <?PHP foreach ($data as $slider): if ($two == 1) {
            $two = 2; ?>
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>

        <?PHP } else { ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?=$counter?>"></li>
        <?PHP } $counter++; ?>
        <?PHP endforeach; ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?PHP foreach ($data as $slider): if ($first == 1) {
            $first = 2; ?>
            <div class="item active">
                <img src="<?= site_url($slider[$tpl->image()]) ?>" class="img-responsive">

                <div class="carousel-caption">
                    <?= $slider[$tpl->text()] ?>
                </div>
            </div>
        <?PHP } else { ?>
            <div class="item">
                <img src="<?= site_url($slider[$tpl->image()]) ?>" class="img-responsive">

                <div class="carousel-caption">
                    <?= $slider[$tpl->text()] ?>
                </div>
            </div>
        <?PHP } ?>
        <?PHP endforeach; ?>


    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<?= $content ?>
<!-- FOOTER -->
<div id="f">
    <div class="container">
        <div class="row centered">
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-facebook"></i></a>
        </div>
    </div>
    <!-- container -->
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">On Map</h4>
            </div>
            <div class="modal-body">
                <div class="row centered">

                    <div id="mapwrap">
                        <iframe height="400" width="100%" frameborder="0" scrolling="no" marginheight="0"
                                marginwidth="0"
                                src="https://www.google.es/maps?t=m&amp;ie=UTF8&amp;ll=32.0113909,35.9344943&amp;spn=67.34552,156.972656&amp;z=16&amp;output=embed"></iframe>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

</body>
</html>
