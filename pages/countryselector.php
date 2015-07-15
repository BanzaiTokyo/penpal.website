<?php
/**
 * Created by PhpStorm.
 * User: dl07epif
 * Date: 17/11/2014
 * Time: 11:50
 */

$requete    = "select  distinct(name) as countryname, code
                from countries as c join pro_membersu as m
                on c.code=m.country
                where m.status <> 20
                and m.pic1 <>''
                and m.pic1 is not null
                order by countryname";

$res=mysql_query($request);
$req 		= 	mysql_query($requete) or die("pb sur requete ".$requete);

//-> On va boucler pour créer  autant de lignes de titre que de pages trouvées

while ($donnees = mysql_fetch_array ($req)) {
    $countryname = $donnees['countryname'];
$country=$donnees['code'];

    $countryselector = $countryselector . '
                        <li role="presentation">  <a role="menuitem" tabindex="-1" href="browse.php?country='.$country.'"> <img src="./images/16/'.strtolower($country).'.png"> '.$countryname.'</a></li>
                        ';

}

echo $countryselector;

?>