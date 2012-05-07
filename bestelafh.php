<?php
$title="Bestelling afhandelen";
require_once "includes/header.php";
require_once "includes/db_functions.php" ;
session_start();
$conn=get_db_connection();
$data=array();
// echo count($users);
// print_r($_POST);
$bestelling=array();

if(isset($_POST["submit"]))
{
	if(isset($_POST["tafel"]) && $_POST["tafel"]!= '')
	{
		$tafel=$_POST["tafel"];
		handel_bestelling_tafel($conn,$tafel);
	}else
	{
		echo "kies een tafel";
	}
}


?>

<div id="content">
	<table border="1px">
	<th>tafel</th><th>product</th><th>aantal</th>
<?php
 table_niet_afgehandeld($conn);
?>
</table>
<form id="toevoegen" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

tafel :<select name="tafel"> <?php 
	echo '<option value="' . "" . '">' . " " . '</option>';
	fill_option_tafel_best($conn);
	?></select></br>  

<input type="submit" name="submit" value="toevoegen"/>
</form>
</div>

<?php
require_once "includes/footer.php";
?>
</html>