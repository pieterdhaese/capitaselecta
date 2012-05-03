<?php
// $title="administratie";
// require_once "includes/header.php";
require_once "includes/db_functions.php" ;
$conn=get_db_connection();
$data=array();
// echo count($users);
// print_r($_POST);
if(isset($_POST["submit"]))
{


?>

<div id="content">
<ul>
<li><a href="toevoegenpr.php">producten toevoegen</a></li>
<li><a href="verwijderenpr.php">producten verwijderen</a></li>
<li><a href="toevoegencat.php">producten verwijderen</a></li>
<li><a href="verwijderencat.php">producten verwijderen</a></li>
<li><a href="overzichtaf.php">overzicht afgehandeld</a></li>
<li><a href="overzichtopen.php">overzicht openstaand</a></li>
</ul>
</div>


<div id="footer_text_register">
<h11>by Pieter D'haese &copy; 2012 All Rights Reserved<h11>        
        </div>
</div>

</div>


</body>
</html>