<?php
$title="Product verwijderen";
require_once "includes/header.php";
require_once "includes/db_functions.php" ;
session_start();
$conn=get_db_connection();
$data=array();
// echo count($users);
// print_r($_POST);
if(isset($_POST["submit"]))
{
	if (isset($_POST["product"]) && $_POST["product"]!= '')
	{
		delete_product_in_database($_POST["product"],$conn);
	}else
	{
		echo "kies een product";
	}
}

?>

<div id="content">
<ul>
<form id="verwijderen" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<select name="product">
	<?php echo '<option value="' . "" . '">' . " " . '</option>';
	fill_option_product($conn);
	?></select></br> 

<input type="submit" name="submit" value="verwijderen"/>
</form>
</ul>
</div>


<?php
require_once "includes/footer.php";
?>