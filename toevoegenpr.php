<?php
// $title="Product toevoegen";
// require_once "includes/header.php";
require_once "includes/db_functions.php" ;
$conn=get_db_connection();
$data=array();
// echo count($users);
// print_r($_POST);

?>
<html>
<head></head>
<body>
<div id="content">
<form id="toevoegen">
naam : <input name="productnaam" type="text"/></br>
categorie : <input name="productcategorie" type="text"/></br>  <!-- combobox maken met cat -->
prijs : <input name="productprijs" type="text"/></br>
<input type="submit" name="submit" value="toevoegen"/>
</form>
</div>


<div id="footer_text_register">
<h11>by Pieter D'haese &copy; 2012 All Rights Reserved<h11>        
        </div>

</body>
</html>