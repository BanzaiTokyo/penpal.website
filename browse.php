<!DOCTYPE html>
<?php include "config.php" ?>
<?php include "includes/preparation.php"?>

<html lang="en">
<head>

    <title>Browse penpals</title>
    <meta name="description" content="<?php echo $description ?> " />
    <meta name="keywords" content="<?php echo $keywords ?>" />

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>

        Penpal.Website

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
<?php include_once("./details/analyticstracking.php") ?>
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
            <a href="./" class="navbar-brand">Penpal.Website</a>
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
<?php include "pages/header-browse.php" ?>


<div class="container bs-docs-container">

<div class="row">
<div class="col-md-12" role="main">
<div class="bs-docs-section">


    <!--browse part /-->
    <?php
    if (isset($_GET['country']))
    { $selectedCountry=$_GET['country']; }
    else
    {$selectedCountry="";}


    //Préparation du menu dynamique
    //-----------------------------
    //-> On sélectionne toutes les pages de la table sitepages
    $requete    = "  SELECT regdate, id_member, fname, lname, city, profilepic, country
                FROM members
                where profilepic is not null
                and country like '".strtoupper($selectedCountry)."%'
                ORDER BY regdate DESC
                limit 18";
    $req 		= 	mysql_query($requete) or die("pb sur requete ".$requete);

    //-> On va boucler pour créer  autant de lignes de titre que de pages trouvées

    while ($donnees = mysql_fetch_array ($req))
    {
        $username 		= $donnees['fname']." ".$donnees['lname'];
        $city 	= $donnees['city'];
        $id = $donnees['id_member'];
        $country = $donnees['country'];
        $photo = "<img src=./members/uploads/".$donnees['profilepic'].">";

        $browsetable		= $browsetable.'
    <a href="profile.php?id='.$id.'">
                <div class="col-xs-6 col-sm-3 col-md-2">
                    <div class="thumbnail person">
                        '.$photo.'

                        <div>

                            <div type="button" class="btn btn-disabled btn-block btn-xs">
                                <span class="glyphicon glyphicon-user"></span>'.$username.'
                            </div>


                            <img src="./images/16/'.strtolower($country).'.png" alt="'.$country.'"> '. $city.'

                        </div>
                    </div>
                </div>
            </a>';

    }

    ?>










    <br />

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="col-lg-2"><h4>Select the country:</h4></div>
            <div class="col-lg-2">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                        Country
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

<?php include "pages/countryselector.php" ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <div class="row">



        <?php
        /**
         * Created by PhpStorm.
         * User: dl07epif
         * Date: 19/11/2014
         * Time: 15:03
         */

        $conn = mysql_connect($host,$user,$pass) or die ("erreur de connexion au serveur");
        $db = mysql_select_db($bdd) or die ("erreur de connexion à la base de données");


        // find out how many rows are in the table
        $sql = "SELECT count(*)
                FROM members
                where profilepic  is not null
                and country like '".strtoupper($selectedCountry)."%'
                ORDER BY regdate DESC";

        $result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
        $r = mysql_fetch_row($result);
        $numrows = $r[0];

        // number of rows to show per page
        $rowsperpage = 18;
        // find out total pages
        $totalpages = ceil($numrows / $rowsperpage);

        // get the current page or set a default
        if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
            // cast var as int
            $currentpage = (int) $_GET['currentpage'];
        } else {
            // default page num
            $currentpage = 1;
        } // end if

        // if current page is greater than total pages...
        if ($currentpage > $totalpages) {
            // set current page to last page
            $currentpage = $totalpages;
        } // end if
        // if current page is less than first page...
        if ($currentpage < 1) {
            // set current page to first page
            $currentpage = 1;
        } // end if

        // the offset of the list, based on current page
        $offset = ($currentpage - 1) * $rowsperpage;

        // get the info from the db
        $sql = "SELECT regdate, id_member, fname, lname, city, profilepic, country
                FROM members
                where profilepic is not null
                and country like '".strtoupper($selectedCountry)."%'
                ORDER BY regdate DESC
                LIMIT $offset, $rowsperpage";

        $result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);

        // while there are rows to be fetched...
        while ($list = mysql_fetch_assoc($result)) {


                $username 		= $list['fname']." ".$list['lname'];
                $city 	= $list['city'];
                $id = $list['id_member'];
                $country = $list['country'];
                $photo = "<img src=./members/uploads/".$list['profilepic'].">";

                $pagedtable		= $pagedtable.'
    <a href="profile.php?id='.$id.'">
                <div class="col-xs-6 col-sm-3 col-md-2">
                    <div class="thumbnail person">
                        '.$photo.'

                        <div>

                            <div type="button" class="btn btn-disabled btn-block btn-xs">
                                <span class="glyphicon glyphicon-user"></span>'.$username.'
                            </div>


                            <img src="./images/16/'.strtolower($country).'.png" alt="'.$country.'"> '. $city.'

                        </div>
                    </div>
                </div>
            </a>';


        } // end while
echo $pagedtable;


        /******  build the pagination links ******/
        // range of num links to show
        $range = 3;

        // if not on page 1, don't show back links
        if ($currentpage > 1) {
            // show << link to go back to page 1
            $linkstopages = " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
            // get previous page num
            $prevpage = $currentpage - 1;
            // show < link to go back to 1 page
            $linkstopages = $linkstopages . " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
        } // end if

        // loop to show links to range of pages around current page
        for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
            // if it's a valid page number...
            if (($x > 0) && ($x <= $totalpages)) {
                // if we're on current page...
                if ($x == $currentpage) {
                    // 'highlight' it but don't make a link
                    $linkstopages = $linkstopages . " [<b>$x</b>] ";
                    // if not current page...
                } else {
                    // make it a link
                    $linkstopages = $linkstopages . " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
                } // end else
            } // end if
        } // end for

        // if not on last page, show forward and last page links
        if ($currentpage != $totalpages) {
            // get next page
            $nextpage = $currentpage + 1;
            // echo forward link for next page
            $linkstopages = $linkstopages . " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
            // echo forward link for lastpage
            $linkstopages = $linkstopages . " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
        } // end if
        /****** end build pagination links ******/
        ?>

    </div>

    <?php echo '<div class="row">'.$linkstopages."</div>";?>
<!-- end browse part /-->






</div>




<!-- Footer
================================================== -->
<footer class="bs-docs-footer" role="contentinfo">
    <div class="container">
        <p>PenpalsFinder was created back in 2003 or so and it has been put to sleep in 2007. It's time to bring it back to life. </p>


        <ul class="bs-docs-footer-links muted">
            <li>Penpal.Website</li>
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