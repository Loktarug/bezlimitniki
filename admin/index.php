<?php
error_reporting(E_ALL);
include_once('../engine/dbOperations.php');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ru" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Bezlimitniki.ru | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }
    </style>
    <link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../bootstrap/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../bootstrap/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../bootstrap/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../bootstrap/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../bootstrap/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>

<div class="modal hide" id="modalAddTariff">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Тариф добавлен</h3>
    </div>
    <div class="modal-body">
        <p>Информация о тарифе</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Закрыть</a>
        <!--<a href="#" class="btn btn-primary">Save changes</a>-->
    </div>
</div>

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="index.php">Bezlimitniki.ru</a>
            <div class="btn-group pull-right">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-user"></i> Username
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Sign Out</a></li>
                </ul>
            </div>
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active"><a href="index.php?type=tariffs">Тарифы</a></li>
                    <li><a href="index.php?type=phones">Телефоны</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>


<?php

if (isset ($_REQUEST['type']))
    $type = $_REQUEST['type'];
else
    $type = 'tariffs';

if ($type == 'tariffs')
{
    include_once('tariffs.php');
}
elseif ($type == 'phones')
{

}

?>
<!--/.fluid-container-->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://code.jquery.com/jquery-1.8.0.min.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-transition.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-alert.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-modal.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-dropdown.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-scrollspy.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-tab.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-tooltip.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-popover.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-button.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-collapse.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-carousel.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="../bootstrap/js/forms.js" type="text/javascript"></script>

</body>
</html>
