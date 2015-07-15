<!DOCTYPE html>
<?php include "config.php" ?>
<?php include "includes/preparation.php"?>

<html lang="en">
<head>

    <title>PenpalsFinder.com</title>
    <meta name="description" content="<?php echo $description ?> " />
    <meta name="keywords" content="<?php echo $keywords ?>" />

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>

        PenpalsFinder.com

    </title>

    <!-- Bootstrap core CSS -->

    <link href="./dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Optional Bootstrap Theme -->

    <link href="data:text/css;charset=utf-8," data-href="./dist/css/bootstrap-theme.min.css" rel="stylesheet"
          id="bs-theme-stylesheet">


    <!-- Documentation extras -->

    <link href="./assets/css/docs.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="./assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="/favicon.ico">


</head>
<body>
<?php include_once("./pages/analyticstracking.php") ?>
<a class="sr-only sr-only-focusable" href="#content">Skip to main content</a>

<!-- Docs master nav -->
<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse"
                    data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="http://penpalsfinder.com" class="navbar-brand">PenpalsFinder.com</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">

                <?php echo $menu; ?>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php echo $navbarright ?>
            </ul>
        </nav>
    </div>
</header>


<!-- Docs page layout -->


<!--this is the presentation part of the header/-->
<?php include "pages/header-".$pagename ?>


<div class="container bs-docs-container">

<div class="row">
<div class="col-md-12" role="main">
<div class="bs-docs-section">

<?php include "pages/".$pagename ?>

</div>




<!-- Footer
================================================== -->
<footer class="bs-docs-footer" role="contentinfo">
    <div class="container">
        <p>PenpalsFinder was created back in 2003 or so and it has been put to sleep in 2007. It's time to bring it back to life. </p>


        <ul class="bs-docs-footer-links muted">
            <li>PenpalsFinder</li>
            <li>&middot;</li>
            <li class="active">
                <a href="#">Home</a>
            </li>
            <li>&middot;</li>
            <li>
                <a href="#">Find penpals</a>
            </li>
            <li>&middot;</li>
            <li >
                <a href="#">About</a>
            </li>
        </ul>
    </div>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<script src="./dist/js/bootstrap.min.js"></script>


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="./assets/js/ie10-viewport-bug-workaround.js"></script>


<!-- Analytics
================================================== -->

</div>
</div>
</div>
    </div>

</body>
</html>
