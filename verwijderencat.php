<?php
$title="categorie verwijderen";
require_once "includes/header.php";
require_once "includes/db_functions.php" ;
session_start();
$conn=get_db_connection();
$data=array();
// echo count($users);
// print_r($_POST);
if(isset($_POST["submit"]))
{
	if (isset($_POST["categorie"]) && $_POST["categorie"]!= '')
	{
		delete_cat_in_database($_POST["categorie"],$conn);
	}else
	{
		echo "kies een categorie";
	}
}

?>

<div id="content">
<ul>
<form id="verwijderen" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<select name="categorie">
	<?php echo '<option value="' . "" . '">' . " " . '</option>';
	fill_option_cat($conn);
	?></select></br> 

<input type="submit" name="submit" value="verwijderen"/>
</form>
</ul>
</div>


<?php
require_once "includes/footer.php";
?>