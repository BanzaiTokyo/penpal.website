<?php
/**
 * Created by PhpStorm.
 * User: dl07epif
 * Date: 13/11/2014
 * Time: 11:46
 */

$getcountriesexceptunwanted    = "SELECT m.country, c.cname as name, count(m.id_member) as totalmembers
FROM members  as m left join countries as c on m.country=c.id_country
where level >= 3
group by country
order by totalmembers desc
limit 6;";
$topcountries 		= 	mysql_query($getcountriesexceptunwanted) or die("pb sur requete ".$getcountriesexceptunwanted);

//-> On va boucler pour créer  autant de lignes de titre que de pages trouvées

while ($donnees = mysql_fetch_array ($topcountries))
{
    $country = $donnees['country'];
    $countryname = $donnees['name'];
    $count = $donnees['totalmembers'];
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
