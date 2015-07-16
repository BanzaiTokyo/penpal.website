<?php
/**
 * Created by PhpStorm.
 * User: dl07epif
 * Date: 12/11/2014
 * Time: 14:57
 */


$requete    = "SELECT id_member, fname, lname, city, profilepic, country FROM members where profilepic is not null ORDER BY RAND() limit 6";
$req 		= 	mysql_query($requete) or die("pb sur requete ".$requete);

//-> On va boucler pour créer  autant de lignes de titre que de pages trouvées

while ($donnees = mysql_fetch_array ($req))
{
    $username 		= $donnees['fname']." ".$donnees['lname'];
    $city 	= $donnees['city'];
	$country = $donnees['country'];
    $photo = "<img src=./members/uploads/".$donnees['profilepic'].">";
    $id = $donnees['id_member'];

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

echo $browsetable;
?>









