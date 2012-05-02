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
	
	function get_users($conn)
	{
		$query = "SELECT * FROM datalife_members";
		return mysqli_query($conn,$query);
	}
		
	function fill_option_users($conn)
	{
		$result=get_values(get_users($conn));
		for ($i=0;$i<count($result);$i++){
		echo '<option value="' . $result[$i]["ID"] . '">' . $result[$i]["username"] .'</option>';
		}
	}
	
	function put_user_in_database($user,$conn)
	{
		$query=	"INSERT INTO datalife_members(username,voornaam,achternaam,password,email) VALUES('".$user['login']."','".$user['voornaam']."','".$user['achternaam']."','".$user['password']."','".$user['email']."');";
		mysqli_query($conn,$query);
	}
	
	function put_werf_in_database($werf,$conn)
	{
		$query=	"INSERT INTO datalife_werven(werf_naam,werf_plaats) VALUES('".$werf['werf_naam']."','".$werf['werf_locatie']."');";
		echo $query;
		mysqli_query($conn,$query);
	}
	
	function put_data_in_database($data,$conn)
	{
		$query=	"INSERT INTO datalife_member_werf(member_id,datum,werf_id,begin_uur,eind_uur,chauffeur,pauze) VALUES('".$data['member_id']."','".$data['datum']."','".$data['werf_id']."','".$data['begin_uur']."','".$data['eind_uur']."','".$data['chauffeur']."','".$data['pauze']."');";
		// echo $query;
		mysqli_query($conn,$query);
	}
	
	function fill_option_werf($conn)
	{
		$query = "select * from datalife_werven";
		$result=get_values(mysqli_query($conn,$query));
		for ($i=0;$i<count($result);$i++){
		echo '<option value="' . $result[$i]["ID"] . '">' . $result[$i]["werf_naam"] ." - ". $result[$i]["werf_plaats"] . '</option>';
		}
	}

	function get_all_days($conn)
	{
		$query = "select * from datalife_member_werf";
		$result=get_values(mysqli_query($conn,$query));
		return $result;
	}
	
	function get_user($id,$conn)
	{
		$query="SELECT voornaam,achternaam FROM datalife_members where ID = $id;";
		$result=get_values(mysqli_query($conn,$query));
		return $result;
	}
	
	function get_werf($id,$conn)
	{
		$query="SELECT CONCAT(werf_naam, werf_plaats)  AS werf_full FROM datalife_werven where ID = $id;";
		$result=get_values(mysqli_query($conn,$query));
		return $result;
	}
	
	function prepare($data,$conn)
	{
		$dataprep=array();
		
		for ($i=0;$i<count($data);$i++){
		$data2=get_user($data[$i]["member_id"],$conn);
		$dataprep[$i]["voornaam"]= $data2[0]["voornaam"];
		$dataprep[$i]["achternaam"]= $data2[0]["achternaam"];		
		$werf=get_werf($data[$i]["werf_id"],$conn);
		$dataprep[$i]["werfnaam"]=$werf[0]["werf_full"];
		$dataprep[$i]["begin_uur"]=$data[$i]["begin_uur"];
		$dataprep[$i]["eind_uur"]=$data[$i]["eind_uur"];
		$data3=get_user($data[$i]["chauffeur"],$conn);
		// print_r($data2);
		$dataprep[$i]["chauffeur"]= $data3[0]["voornaam"]." ".$data3[0]["achternaam"];
		$dataprep[$i]["pauze"]=$data[$i]["pauze"];
		// print_r($dataprep);
		
		}
		return $dataprep;
		
	}
	
	function write_profiel_table($data,$conn)
	{
		$data2=prepare($data,$conn);
		echo "<table>";
		echo "<th>voornaam</th><th>achternaam</th><th>werf</th><th>beginuur</th><th>einduur</th><th>chauffeur</th><th>pauze</th>";
		
			for($i=0;$i<count($data2);$i++)
			{
				echo "<tr><td>".$data2[$i]["voornaam"]."</td><td>".$data2[$i]["achternaam"]."</td><td>".$data2[$i]["werfnaam"]."</td><td>".$data2[$i]["begin_uur"]."</td><td>".$data2[$i]["eind_uur"]."</td><td>".$data2[$i]["chauffeur"]."</td><td>".$data2[$i]["pauze"]."</td></tr>";
			}
		echo "</table>";	
		}
		
		function write_csv ($str_filename,$data) {
		$file = fopen($str_filename,"w");
		for ($i=0; $i<count($data);$i++) {		
			for ($j=0; $j<count($data[$i]); $j++){
				fputcsv($file, $data[$i][$data[$i][$j]],";");
			}
		}
		fclose($file);
	}
?>