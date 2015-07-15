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



</div>






