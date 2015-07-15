<?php
if (isset($_GET['country']))
{ $selectedCountry=$_GET['country']; }
else
{$selectedCountry="";}


//Préparation du menu dynamique
//-----------------------------
//-> On sélectionne toutes les pages de la table sitepages
$requete    = "  SELECT regdate, id, fname, lname, city, pic1, country
                FROM penpalsf_site.pro_membersu
                where pic1 is not null
                  and pic1 <> ''
                  and status <> 20
                  and country like '".strtoupper($selectedCountry)."%'
                ORDER BY regdate DESC
                limit 18";
$req 		= 	mysql_query($requete) or die("pb sur requete ".$requete);

//-> On va boucler pour créer  autant de lignes de titre que de pages trouvées

while ($donnees = mysql_fetch_array ($req))
{
    $username 		= $donnees['fname']." ".$donnees['lname'];
    $city 	= $donnees['city'];
    $id = $donnees['id'];
	$country = $donnees['country'];
    $photo = "<img src=./members/uploads/".$donnees['pic1'].">";

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
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">United States</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Russia</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">France</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Trinidad and Tobago</a></li>
                </ul>
            </div>
        </div>

    </div>
</div>
<div class="row">

<!--1 to 6-->
<?php echo $browsetable ?>



<nav class="col-xs-12 minuspadding">
    <ul class="pager">
        <li class="previous disabled"><a href="#">&larr; Newer</a></li>
        <li class="next"><a href="#">Older &rarr;</a></li>
    </ul>
</nav>

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
                FROM penpalsf_site.pro_membersu
                where pic1 is not null
                  and pic1 <> ''
                  and status <> 20
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
    $sql = "SELECT regdate, id, fname, lname, city, pic1, country
                FROM penpalsf_site.pro_membersu
                where pic1 is not null
and pic1 <> ''
and status <> 20
and country like '".strtoupper($selectedCountry)."%'
                ORDER BY regdate DESC
                LIMIT $offset, $rowsperpage";

    $result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);

    // while there are rows to be fetched...
    while ($list = mysql_fetch_assoc($result)) {
        // echo data
        echo $list['id'] . " : " . $list['number'] . "<br />";
    } // end while

    /******  build the pagination links ******/
    // range of num links to show
    $range = 3;

    // if not on page 1, don't show back links
    if ($currentpage > 1) {
        // show << link to go back to page 1
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
        // get previous page num
        $prevpage = $currentpage - 1;
        // show < link to go back to 1 page
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
    } // end if

    // loop to show links to range of pages around current page
    for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
        // if it's a valid page number...
        if (($x > 0) && ($x <= $totalpages)) {
            // if we're on current page...
            if ($x == $currentpage) {
                // 'highlight' it but don't make a link
                echo " [<b>$x</b>] ";
                // if not current page...
            } else {
                // make it a link
                echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
            } // end else
        } // end if
    } // end for

    // if not on last page, show forward and last page links
    if ($currentpage != $totalpages) {
        // get next page
        $nextpage = $currentpage + 1;
        // echo forward link for next page
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
        // echo forward link for lastpage
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
    } // end if
    /****** end build pagination links ******/
    ?>



</div>






