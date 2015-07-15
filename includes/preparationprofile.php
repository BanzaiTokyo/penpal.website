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
$query 	 		= 'select fname, lname, birthday, gender, country, city, descr, pic1 from pro_membersu where id='.$id;
$result  		= mysql_query($query) or die("problème (huj) dans la requete : ".$query);
$row 	 		= mysql_fetch_array($result);
$fname		= $row['fname'];
$lname		= $row['lname'];
$descr = $row['descr'];
$gender		= $row['gender'];
$birthday   = $row['birthday'];
$code = $row['country'];
$city       = $row['city'];
$picture    = $row['pic1'];

$query 	 		= 'select name from countries where code = "'.$code.'"';
$result  		= mysql_query($query) or die("problème (huj) dans la requete : ".$query);
$row 	 		= mysql_fetch_array($result);
$country=$row['name'];
?>

