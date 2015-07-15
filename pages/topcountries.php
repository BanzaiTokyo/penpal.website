<?php
/**
 * Created by PhpStorm.
 * User: dl07epif
 * Date: 13/11/2014
 * Time: 11:46
 */

$getcountriesexceptunwanted    = "SELECT p.country, c.name as name, count(p.id) as schet
FROM penpalsf_site.pro_membersu  as p left join countries as c on p.country=c.code
where status <> 20
group by country
order by schet desc
limit 6;";
$topcountries 		= 	mysql_query($getcountriesexceptunwanted) or die("pb sur requete ".$getcountriesexceptunwanted);

//-> On va boucler pour créer  autant de lignes de titre que de pages trouvées

while ($donnees = mysql_fetch_array ($topcountries))
{
    $country = $donnees['country'];
    $countryname = $donnees['name'];
    $count = $donnees['schet'];
    $countrytable		= $countrytable.'

            <a href="browse.php?country='.$country.'">
            <div class="col-xs-4 col-sm-2 col-md-2">
                <div class="thumbnail ">
                    <img src="./images/48/'.strtolower($country).'.png">

                    <p class="text-center">
'.$countryname.'                  </p>
                </div>
            </div>
        </a>';

}

echo $countrytable;
?>
