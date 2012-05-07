<?php
$title="overzicht voltooide bestellingen";
require_once "includes/header.php";
session_start();
require_once "includes/db_functions.php" ;
$conn=get_db_connection();
$data=array();

?>

<div id="content">
	<table border="1px">
	<th>tafel</th><th>product</th><th>totprijs</th><th>aantal</th>
<?php
 table_voltooid($conn);
?>
</table>
</div>


<?php
require_once "includes/footer.php";
?>