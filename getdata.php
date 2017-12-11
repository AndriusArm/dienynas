<?php
include_once("include/session.php");

if(!empty($_POST["id"])) {
	$userID = $session->userinfo["id_Vartotojas"];
	$id=$_POST["id"];
	if($id != 1) {
	$query="SELECT id_Vartotojas, vardas, pavarde FROM vartotojas WHERE lygis=$id AND lygis!='1' and id_Vartotojas != $userID";
	echo "<option value=''>Pasirinkite gavėją</option> ";
	$result=$database->query($query);
	
	while ($row = mysqli_fetch_array($result)) {
		echo "<option value='" .$row['id_Vartotojas'] ."'>" .$row['vardas'] . " " .$row['pavarde']. "</option>";					
	}   
} else {
	if($session->isMokinys()) {
	$userID = $session->userinfo["id_Vartotojas"];
	$query2="SELECT fk_klase from mokinys where mokinys.id_Vartotojas=$userID limit 1";
	$result2=$database->query($query2);
	$row1 = mysqli_fetch_array($result2);
	$class = $row1['fk_klase'];
	$query="SELECT vartotojas.id_Vartotojas, vardas, pavarde FROM vartotojas, mokinys WHERE lygis='1' and vartotojas.id_Vartotojas=mokinys.id_Vartotojas and mokinys.fk_Klase=$class and mokinys.id_Vartotojas != $userID";
	echo "<option value=''>Pasirinkite gavėją</option> ";
	$result=$database->query($query);
	
	while ($row = mysqli_fetch_array($result)) {
		echo "<option value='" .$row['id_Vartotojas'] ."'>" .$row['vardas'] . " " .$row['pavarde']. "</option>";					
	}  
	} else {
		$query3="SELECT vartotojas.id_Vartotojas, vardas, pavarde FROM vartotojas, mokinys WHERE lygis='1' and vartotojas.id_Vartotojas=mokinys.id_Vartotojas";
	echo "<option value=''>Pasirinkite gavėją</option> ";
	$result3=$database->query($query3);
	
	while ($row3 = mysqli_fetch_array($result3)) {
		echo "<option value='" .$row3['id_Vartotojas'] ."'>" .$row3['vardas'] . " " .$row3['pavarde']. "</option>";					
	}  

	}
}
}

?>