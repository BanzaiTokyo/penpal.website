<?php
if (isset($_GET['id']))
{ $id=$_GET['id']; }
else
{$id="0";}


//Récupération des informations sur la page dans notre Base de données
//--------------------------------------------------------------------
mysql_connect($host,$user,$pass) or die ("erreur de connexion au serveur");
mysql_select_db($bdd) or die ("erreur de connexion à la base de données");

//Requete SQL pour récupérer des informations dans la BDD
$query 	 		= 'select fname, lname, birthday, gender, country, city, about, profilepic from members where id_member='.$id;
$result  		= mysql_query($query) or die("problème dans la requete : ".$query);
$row 	 		= mysql_fetch_array($result);
$fname		= $row['fname'];
$lname		= $row['lname'];
$descr = $row['about'];
$gender		= $row['gender'];
$birthday   = $row['birthday'];
$code = $row['country'];
$city       = $row['city'];
$picture    = $row['profilepic'];

$query 	 		= 'select cname from countries where id_country = "'.$code.'"';
$result  		= mysql_query($query) or die("problème dans la requete : ".$query);
$row 	 		= mysql_fetch_array($result);
$country=$row['cname'];
?>

