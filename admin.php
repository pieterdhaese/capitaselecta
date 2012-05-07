<?php
$title="administratie";
require_once "includes/header.php";
require_once "includes/db_functions.php" ;
session_start();
$conn=get_db_connection();
$data=array();

?>

<div id="content">
<ul>
<li><a href="toevoegenpr.php">producten toevoegen</a></li>
<li><a href="verwijderenpr.php">producten verwijderen</a></li>
<li><a href="toevoegencat.php">categorie toevoegen</a></li>
<li><a href="verwijderencat.php">categorie verwijderen</a></li>
<li><a href="overzichtopen.php">overzicht openstaand</a></li>
<li><a href="overzichtaf.php">overzicht afgehandeld</a></li>
<li><a href="overzichtvolt.php">overzicht betaald</a></li>
</ul>
</div>


<?php
require_once "includes/footer.php";
?>