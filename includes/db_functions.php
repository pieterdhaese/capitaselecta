<?php
require_once("connectvars.php");
//make database connection
	function get_db_connection () 
	{
		
		return mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	}
	
	// returns an array with all the values of a resultset
	// parameters: $resultset: resultset from a mysqli_query
	// returns: array with values of the resultset
	function get_values ($resultset) {
		$data = array();
		for ($i=0; $i<mysqli_num_rows($resultset); $i++) {
			$row = mysqli_fetch_assoc($resultset);
			array_push($data,$row);
		}
		return $data;
	}
	//----------------------------//
	// databasefuncties ivm users //
	//----------------------------//
	
	function get_all_users($conn)
	{
		$query = "SELECT * FROM user";
		return get_values(mysqli_query($conn,$query));
	}
	
	function put_user_in_database($user,$conn)
	{
		$query=	"INSERT INTO user(username,first_name,last_name,password,email) VALUES('".$user['login']."','".$user['voornaam']."','".$user['achternaam']."','".$user['password']."','".$user['email']."');";
		mysqli_query($conn,$query);
	}
	
	function delete_user_in_database($user,$conn)
	{
		$query=	"DELETE FROM user WHERE ID=$user;";
		mysqli_query($conn,$query);
	}
	
	//------------------------------------//
	// databasefuncties ivm met categorie //
	//------------------------------------//
	
	function get_all_categorie($conn)
	{
		$query = "SELECT * FROM categorie";
		return mysqli_query($conn,$query);
	}
	
	function put_cat_in_database($cat,$conn)
	{
		$query=	"INSERT INTO categorie(naam) VALUES('$cat');";
		mysqli_query($conn,$query);
		// echo $query;
	}
	
	// $cat -> ID 
	function delete_cat_in_database($cat,$conn)
	{
		$query=	"DELETE FROM categorie WHERE ID=$cat;";
		mysqli_query($conn,$query);
	}
	
	function fill_option_cat($conn)
	{
		$result=get_values(get_all_categorie($conn));
		for ($i=0;$i<count($result);$i++){
		echo '<option value="' . $result[$i]["ID"] . '">' . $result[$i]["naam"] .'</option>';
		}
	}
	
	//----------------------------------//
	// databasefuncties ivm met product //
	//----------------------------------//
	
	function get_all_product($conn)
	{
		$query = "SELECT * FROM producten";
		return mysqli_query($conn,$query);
	}
	
	function put_product_in_database($product,$conn)
	{
	$query=	"INSERT INTO producten(naam,categorie,prijs) VALUES('".$product['naam']."','".$product['categorie']."','".$product['prijs']."');";
		mysqli_query($conn,$query);
	}
	
	function delete_product_in_database($product,$conn)
	{
		$query=	"DELETE FROM producten WHERE ID=$product;";
		mysqli_query($conn,$query);
	}
	
	function fill_option_product($conn)
	{
		$result=get_values(get_all_product($conn));
		for ($i=0;$i<count($result);$i++){
		echo '<option value="' . $result[$i]["ID"] . '">' . $result[$i]["naam"] .'</option>';
		}
	}
	
	//-------------------------------------//
	// databasefuncties ivm met bestelling //
	//-------------------------------------//
	
	
	// algemene functies
	
	function put_bestelling_in_database($bestelling,$conn)
	{
	$query=	"INSERT INTO bestelling(tafel,product,aantal,user) VALUES('".$bestelling['tafel']."','".$bestelling['product']."','".$bestelling['aantal']."','".$bestelling['user']."');";
		mysqli_query($conn,$query);
		// echo $query;
	}
	
	function get_all_bestelling($conn)
	{
		$query = "SELECT * FROM bestelling";
		return mysqli_query($conn,$query);
	}
	
		
	function get_bestelling_tafel($conn,$tafel) // vraag bestelling op van tafel die niet afgehandeld zijn
	{
		$query = "SELECT * FROM bestelling WHERE tafel=$tafel AND afgehandeld=0;";
		return mysqli_query($conn,$query);
	}
	
	function fill_option_tafel_best($conn,$tafel) // combobox vullen met nog niet afgehandelde bestellingen
	{
		$result=get_values(get_bestelling_nafg($conn));
		for ($i=0;$i<count($result);$i++){
		echo '<option value="' . $result[$i]["tafel"] . '">' . $result[$i]["tafel"] .'</option>';
		}
	}

	// functies voor af te handelen
	function get_bestelling_nafg($conn) // vraag tafels op die niet afgehandeld zijn
	{
		$query = "SELECT tafel,product,aantal FROM bestelling WHERE afgehandeld=0 ";
		return mysqli_query($conn,$query);
	}
	
	function table_niet_afgehandeld($conn)
	{
		$data=prepare_data_nafg($conn);
		
		for ($i=0;$i<count($data);$i++)
		{
			echo "<tr>";
			foreach($data[$i] as $best)
			{
				echo "<td>$best</td>";
			}
			echo "</tr>";
		}
	}
	
	function prepare_data_nafg($conn)
	{
		$data=array();
		$data1=get_values(get_bestelling_nafg($conn));
		$data2=get_values(get_all_product($conn));
		
		for($i=0;$i<count($data1);$i++)
		{
			$data[$i]['tafel']=$data1[$i]['tafel'];
			for($j=0;$j<count($data2);$j++)
			{
				if ($data1[$i]['product']==$data2[$j]['ID'])
				{
					$data[$i]['product']=$data2[$j]['naam'];
				}
			}
			$data[$i]['aantal']=$data1[$i]['aantal'];
		}
		// print_r($data);
		return $data;
	}

	
	function handel_bestelling_tafel($conn,$tafel)
	{
		$query ="UPDATE bestelling SET afgehandeld='1' WHERE tafel=$tafel;" ;
		mysqli_query($conn,$query);
	}
	
	// functies voor te betalen
	
		function get_bestelling_nbet($conn) // vraag tafels op die niet afgehandeld zijn
	{
		$query = "SELECT tafel,product,aantal FROM bestelling WHERE betaald=0 ";
		return mysqli_query($conn,$query);
	}
	
	function table_niet_betaald($conn)
	{
		$data=prepare_data_nbet($conn);
		
		for ($i=0;$i<count($data);$i++)
		{
			echo "<tr>";
			foreach($data[$i] as $best)
			{
				echo "<td>$best</td>";
			}
			echo "</tr>";
		}
	}
	
		function prepare_data_nbet($conn)
	{
		$data=array();
		$totprijs=0;
		$data1=get_values(get_bestelling_nbet($conn)); // niet afgehandelde bestelling
		$data2=get_values(get_all_product($conn));  // alle producten
		
		for($i=0;$i<count($data1);$i++)
		{
			$data[$i]['tafel']=$data1[$i]['tafel'];
			for($j=0;$j<count($data2);$j++)
			{
				if ($data1[$i]['product']==$data2[$j]['ID'])
				{
					$data[$i]['product']=$data2[$j]['naam'];
					$data[$i]['totprijs']=$data2[$j]["prijs"]*$data1[$i]["aantal"];
				}
			}
			$data[$i]['aantal']=$data1[$i]['aantal'];
			
		}
		// print_r($data);
		return $data;
	}
	
	function betaal_bestelling_tafel($conn,$tafel)
	{
		$query ="UPDATE bestelling SET betaald='1' WHERE tafel=$tafel;" ;
		mysqli_query($conn,$query);
	}
	
		function fill_option_tafel_best_bet($conn,$tafel) // combobox vullen met nog niet afgehandelde bestellingen
	{
		$result=get_values(get_bestelling_nbet($conn));
		for ($i=0;$i<count($result);$i++){
		echo '<option value="' . $result[$i]["tafel"] . '">' . $result[$i]["tafel"] .'</option>';
		}
	}
	
	// tabel voor alle betaalde bestellingen

	function table_voltooid($conn)
	{
		$data=prepare_data_volt($conn);
		
		for ($i=0;$i<count($data);$i++)
		{
			echo "<tr>";
			foreach($data[$i] as $best)
			{
				echo "<td>$best</td>";
			}
			echo "</tr>";
		}
	}
	
		function prepare_data_volt($conn)
	{
		$data=array();
		$totprijs=0;
		$data1=get_values(get_all_bestelling($conn)); // niet afgehandelde bestelling
		$data2=get_values(get_all_product($conn));  // alle producten
		
		for($i=0;$i<count($data1);$i++)
		{
			$data[$i]['tafel']=$data1[$i]['tafel'];
			for($j=0;$j<count($data2);$j++)
			{
				if ($data1[$i]['product']==$data2[$j]['ID'])
				{
					$data[$i]['product']=$data2[$j]['naam'];
					$data[$i]['totprijs']=$data2[$j]["prijs"]*$data1[$i]["aantal"];
				}
			}
			$data[$i]['aantal']=$data1[$i]['aantal'];
			
		}
		// print_r($data);
		return $data;
	}