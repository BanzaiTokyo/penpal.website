<?php
//Récupération du numéro de la page à afficher
//--------------------------------------------
	if (isset($_GET['Idpage'])) 
		{ $Idpage=$_GET['Idpage']; }
		else
		{$Idpage="1";}
		
//Récupération des informations sur la page dans notre Base de données	
//--------------------------------------------------------------------
		mysql_connect($host,$user,$pass) or die ("erreur de connexion au serveur");
		mysql_select_db($bdd) or die ("erreur de connexion à la base de données");

 		//Requete SQL pour récupérer des informations dans la BDD
		$query 	 		= "select pagename, title, description, keywords from sitepages where id=".$Idpage;
		$result  		= mysql_query($query) or die("problème dans la requete : ".$query);
		$row 	 		= mysql_fetch_row($result);
		$pagename		= $row[0];
		$title		= $row[1];
		$description = $row[2];
		$keywords		= $row[3];
		
//Préparation du menu dynamique
//-----------------------------
	//-> On sélectionne toutes les pages de la table sitepages
	$requete    = "select * from sitepages order by ordr";
	$req 		= 	mysql_query($requete) or die("pb sur requete ".$requete);
	
	//-> On va boucler pour créer  autant de lignes de titre que de pages trouvées
	$menu="";
	while ($donnees = mysql_fetch_array ($req))
			{
				$lien 		= $donnees['id'];
				$titrelien 	= $donnees['title'];
                if ($lien != $Idpage)
                {
                    $active="";
                }
                else
                {

                    $active = ' class="active"';
                }

				$menu		= $menu."<li".$active."><a href='index.php?Idpage=".$lien."'>".$titrelien."</a></li>";
			}

	$menu= '<li><a href="index.php">Home</a></li>
            <li><a href="browse.php">Browse penpals</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>';

    $navbarright='<li><a href="subscribe.php">Register</a></li>
                <li><a href="subscribe.php">Login</a></li>';
?>	