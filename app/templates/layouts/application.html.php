<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Acme Co CRM</title>
        <meta name="description" content="CRM from Acme Company">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="/web/css/bootstrap.min.css">
        <style>
            body {
                /* Has to be done before including responsive css */
                padding-top: 40px;
            }
        </style>
        <link rel="stylesheet" href="/web/css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="/web/css/main.css">
        <?php echo $view->block('css'); ?>
        <script src="/web/js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="/">Acme Co CRM</a>
                    <div class="nav-collapse collapse pull-right">
                        <ul class="nav">
                            <li class="<?php echo $helper->getNavClass("/"); ?>">
                                <a href="/"><i class="icon-home"></i> Home</a>
                            </li>
                            <li class="<?php echo $helper->getNavClass("contacts"); ?>">
                                <a href="/contacts"><i class="icon-user"></i> Contacts</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <?php echo $yield; ?>
            <hr>
            <footer>
                <p>&copy; Acme Co 2013
                    <a href="/attributions" class="pull-right">Image Credits</a>
                </p>
            </footer>
        </div>
        <?php echo $view->block('js'); ?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/web/js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
        <script src="/web/js/vendor/bootstrap.min.js"></script>
        <script src="/web/js/main.js"></script>
    </body>
</html>
