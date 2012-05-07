<?php
$title="Product toevoegen";
require_once "includes/header.php";
session_start();
require_once "includes/db_functions.php" ;
$conn=get_db_connection();
$data=array();

if (isset($_POST["submit"]))
{
	if(isset($_POST['productnaam'])&& $_POST['productnaam'] != '')
	{
		$data['naam']=$_POST['productnaam'];
		if (isset($_POST['categorie']) && $_POST['categorie'] != '')
		{
			$data['categorie']=$_POST['categorie'];
			if(isset($_POST['prijs'])&& $_POST['prijs'] != '')
			{
			$data['prijs']=$_POST['prijs'];
			// print_r($data);
			put_product_in_database($data,$conn);
			echo $_POST['productnaam'] . "is toegevoegd";
			}else
			{
				echo "vul een prijs in";
			}
			
		}else
		{
			echo "kies een categorie";
		}
	}else
	{
		echo "vul een naam in";
	}
}

// echo count($users);
// print_r($_POST);

?>

<div id="content">
<form id="toevoegen" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
naam : <input name="productnaam" type="text"/></br>

categorie :<select name="categorie"> <?php 
	echo '<option value="' . "" . '">' . " " . '</option>';
	fill_option_cat($conn);
	?></select></br>  
prijs : <input name="prijs" type="text"/></br>
<input type="submit" name="submit" value="toevoegen"/>
</form>
</div>

<?php
require_once "includes/footer.php";
?>