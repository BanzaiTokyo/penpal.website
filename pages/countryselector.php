<?php
/**
 * Created by PhpStorm.
 * User: dl07epif
 * Date: 17/11/2014
 * Time: 11:50
 */

$requete    = "select  distinct(cname) as countryname, id_country
                from countries as c join members as m
                on c.id_country=m.country
                where level >= 3
                and m.profilepic is not null
                order by countryname";

$res=mysql_query($request);
$req 		= 	mysql_query($requete) or die("pb sur requete ".$requete);

//-> On va boucler pour créer  autant de lignes de titre que de pages trouvées

while ($donnees = mysql_fetch_array ($req)) {
    $countryname = $donnees['countryname'];
$country=$donnees['id_country'];

    $countryselector = $countryselector . '
                        <li role="presentation">  <a role="menuitem" tabindex="-1" href="browse.php?country='.$country.'"> <img src="./images/16/'.strtolower($country).'.png"> '.$countryname.'</a></li>
                        ';

}

echo $countryselector;

?>