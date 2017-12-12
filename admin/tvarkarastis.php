<?php
include("../include/session.php");

if (!$session->isAdministratorius()) {
    header("Location: ../index.php");
} else { //Jei administratorius
    ?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Tvarkaraščio redagavimas</title>
            <link href="../include/styles2.css" rel="stylesheet" type="text/css" />
        </head>  
        <body>
            <table class="center"><tr><td>
                        <img src="../pictures/top.jpg"/>
                    </td></tr><tr><td> 
                        <?php
                        $_SESSION['path'] = '../';
                        include("../include/meniu.php");
						include("../include/admin_meniu.php");

						if (isset ($_POST['priskirti'])){
							$klase = $_POST['klase'];
							$pam = $_POST['pam'];
							$vart = $_POST['vart'];
							if($pam != 0 & $klase!= 0 & $vart!= 0){
							$query="INSERT INTO `klasespamoka` (fk_Klase, fk_Pamoka, fk_Mokytojas) VALUES 
							('$klase', '$pam', '$vart')";
							$database->query($query);
						} 	else {
							?>
								<div class="alert">
								<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
								Nepasirinkta pamoka arba mokinys
								</div>
								<?php
								}
						}
						
						if (isset ($_POST['paskirti'])){
							$klase = $_POST['klase'];
							$kabinetas = $_POST['kabinetas'];
							$laikas = $_POST['laikas'];
							$diena = $_POST['diena'];
							var_dump($klase);
							var_dump($kabinetas);
							var_dump($laikas);
							var_dump($diena);
							if($klase != 0 & $kabinetas != "0" & $laikas != "0" & $diena != "0"){
							$query="INSERT INTO `pamokoslaikas` (laikas, kabinetas, savaitesDiena, fk_KlasesPamoka) VALUES 
							('$laikas', '$kabinetas', '$diena', '$klase')";
							$database->query($query);
						} 	else {
							?>
								<div class="alert">
								<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
								Nepasirinkta pamoka, laikas, kabinetas arba savaitės diena
								</div>
								<?php
								}
						}
						
						
						?>
						<table style=" text-align:left;" border="0" cellspacing="5" cellpadding="5">
                        <h3>Priskirti klasei pamoką</h3>
                        <form action="" method="post">
						<fieldset>
							<legend>Pasirinkite klasę, pamoką ir mokytoją</legend>
							<br>
							<?php
							echo'Klasė ';
							$query1 = "SELECT * from klase";
							echo'<select name="klase">';
							echo'<option value="0">Pasirinkite...</option>';
							$klase = $database->query($query1);
							while ( $row=mysqli_fetch_assoc($klase)) {
								echo "<option value='".$row['id_Klase']."'>".$row['klase']."</option>";
								}
							echo"</select>";
							echo"<br><br>";
							echo'Pamoka ';
							$query2 = "SELECT * from pamoka";
							echo'<select name="pam">';
							echo'<option value="0">Pasirinkite...</option>';
							$pam = $database->query($query2);
							while ( $row=mysqli_fetch_assoc($pam)) {
								echo "<option value='".$row['id_Pamoka']."'>".$row['pavadinimas']."</option>";
								}
							echo"</select>";
							echo"<br><br>";
							echo'Mokytojas ';
							$query3 = "SELECT * from vartotojas WHERE lygis=5";
							echo'<select name="vart">';
							echo'<option value="0">Pasirinkite...</option>';
							$vart= $database->query($query3);
							while ( $row=mysqli_fetch_assoc($vart)) {
								echo "<option value='".$row['id_Vartotojas']."'>".$row['vardas']." ".$row['pavarde']."</option>";
								}
							echo"</select>";
							echo"<br><br>";
							?>
						</fieldset>
						<p><input type="submit" class="submit" name="priskirti" value="Priskirti"></p>
						</form>
						</table>
						
						<table style=" text-align:left;" border="0" cellspacing="5" cellpadding="5">
                        <h3>Paskirti pamokai laiką</h3>
                        <form action="" method="post">
						<fieldset>
							<legend>Pasirinkite klasės pamoką, kabinetą, laiką, savaitės dieną</legend>
							<br>
							<?php
							echo'Pamoka ';
							//$query1 = "SELECT * from klasespamoka, pamoka, klase ";
							$query1 = "SELECT * FROM `klase`, `klasespamoka`, `pamoka`, `vartotojas` 
							WHERE `klasespamoka`.fk_Klase = `klase`.id_Klase 
							&& klasespamoka.fk_Pamoka = pamoka.id_Pamoka 
							&& `vartotojas`.`id_Vartotojas` = `klasespamoka`.`fk_Mokytojas`";
							echo'<select name="klase">';
							echo'<option value="0">Pasirinkite...</option>';
							$klase = $database->query($query1);
							while ( $row=mysqli_fetch_assoc($klase)) {
								echo "<option value='".$row['id_Klasespamoka']."'>".$row['klase']." ".$row['pavadinimas']." ".$row['vardas']." ".$row['pavarde']."</option>";
								}
							echo"</select>";
							echo"<br><br>";
							?>
							<p><label class="field" for="kabinetas">Kabinetas </label><input type="text" id="kabinetas" name="kabinetas" class="textbox-100" value="<?php echo isset($fields['kabinetas']) ? $fields['kabinetas'] : ''; ?>" /></p>
							<?php
							echo'Laikas ';
							?>
							<select name="laikas">';
							<option value="0">Pasirinkite...</option>';
							<option value="08:00:00">08:00</option>
							<option value="09:00:00">09:00</option>
							<option value="10:00:00">10:00</option>
							<option value="11:00:00">11:00</option>
							<option value="12:00:00">12:00</option>
							<option value="13:00:00">13:00</option>
							<option value="14:00:00">14:00</option>
							<option value="15:00:00">15:00</option>
							<option value="16:00:00">16:00</option>
							</select>
							<br><br>
							<?php
							echo'Savaitės diena ';
							?>
							<select name="diena">';
							<option value="0">Pasirinkite...</option>';
							<option value="Pirmadienis">Pirmadienis</option>
							<option value="Antradienis">Antradienis</option>
							<option value="Trečiadienis">Trečiadienis</option>
							<option value="Ketvirtadienis">Ketvirtadienis</option>
							<option value="Penktadienis">Penktadienis</option>
							</select>
							<br><br>
						</fieldset>
						<p><input type="submit" class="submit" name="paskirti" value="Paskirti"></p>
						</form>
						</table>
						
						<table style=" text-align:left;" border="0" cellspacing="5" cellpadding="5">
                        <h3>Peržiūrėti tvarkaraštį</h3>
                        <form action="" method="post">
						<fieldset>
							<legend>Pasirinkite klasę arba mokytoją</legend>
							<br>
							<?php
							echo'Klasė ';
							$query = "SELECT * from klase";
							echo'<select name="klase">';
							echo'<option value="0">Pasirinkite...</option>';
							$klase = $database->query($query);
							while ( $row=mysqli_fetch_assoc($klase)) {
								echo "<option value='".$row['id_Klase']."'>".$row['klase']."</option>";
								}
							echo"</select>";
							echo"<br><br>";
							echo'Mokytojas ';
							$query2 = "SELECT vardas, pavarde, id_Vartotojas, pavadinimas from klase, vartotojas, pamoka, klasespamoka 
							WHERE `klasespamoka`.`fk_Pamoka`  = `pamoka`.`id_Pamoka` 
							&& `vartotojas`.`id_Vartotojas` = `klasespamoka`.`fk_Mokytojas`";
							echo'<select name="mok">';
							echo'<option value="0">Pasirinkite...</option>';
							$mok = $database->query($query2);
							while ( $row=mysqli_fetch_assoc($mok)) {
								echo "<option value='".$row['id_Vartotojas']."'>".$row['vardas']." ".$row['pavarde'].", ".$row['pavadinimas']."</option>";
								}
							echo"</select>";
							echo"<br><br>";
							?>
							</fieldset>
						<p><input type="submit" class="submit" name="perziureti" value="Peržiūrėti"></p>
						</form>
						</table>
	
						<?php
						if (isset ($_POST['perziureti'])){
							$klase = $_POST['klase'];
							$mok = $_POST['mok'];
							if($mok == 0 & $klase!= 0){
							?>
							<div style="text-align: left;color:black">                   
                            <h3>Pirmadienis</h3>
							</div>
							<?php
							$query="SELECT laikas, pavadinimas, kabinetas, vardas, pavarde, id_Klase FROM `mokinys`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka`, `klase` 
						WHERE `klase`.`id_Klase` = $klase
						&& `klasespamoka`.fk_Klase = `mokinys`.fk_Klase 
						&& `klasespamoka`.`fk_Mokytojas` = `vartotojas`.`id_Vartotojas` 
						&& `pamokoslaikas`.`savaitesDiena` = 'Pirmadienis' 
						&& `pamokoslaikas`.`fk_KlasesPamoka` = `klasespamoka`.`id_KlasesPamoka` 
						&& klasespamoka.fk_Pamoka = pamoka.id_Pamoka ORDER BY laikas ";
							$result = $database->query($query);
							echo '<table>';
						echo'<th>'.'Nr.'."</th>";
						echo'<th>'.'Laikas'."</th>";
						echo'<th>'.'Pamoka'."</th>";
						echo'<th>'.'Kabinetas'."</th>";
						echo'<th>'.'Mokytojas'."</th>";
						$i=1;
						while ($row = mysqli_fetch_array($result))
						{
							echo'<tbody>';
							echo'<td>'. $i."</td>";
							echo'<th>'. $row['laikas']."</th>";
							echo'<th>'. $row['pavadinimas']."</th>";
							echo'<th>'. $row['kabinetas']."</th>";
							echo'<th>'. $row['vardas'] . " " .$row['pavarde']."</th>";
							$i=$i+1;
							echo'</tbody>';
						}
						echo '</table>';
						?>
							<div style="text-align: left;color:black">                   
                            <h3>Antradienis</h3>
							</div>
							<?php
							$query="SELECT laikas, pavadinimas, kabinetas, vardas, pavarde, id_Klase FROM `mokinys`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka`, `klase` 
						WHERE `klase`.`id_Klase` = $klase
						&& `klasespamoka`.fk_Klase = `mokinys`.fk_Klase 
						&& `klasespamoka`.`fk_Mokytojas` = `vartotojas`.`id_Vartotojas` 
						&& `pamokoslaikas`.`savaitesDiena` = 'Antradienis' 
						&& `pamokoslaikas`.`fk_KlasesPamoka` = `klasespamoka`.`id_KlasesPamoka` 
						&& klasespamoka.fk_Pamoka = pamoka.id_Pamoka ORDER BY laikas ";
							$result = $database->query($query);
							echo '<table>';
						echo'<th>'.'Nr.'."</th>";
						echo'<th>'.'Laikas'."</th>";
						echo'<th>'.'Pamoka'."</th>";
						echo'<th>'.'Kabinetas'."</th>";
						echo'<th>'.'Mokytojas'."</th>";
						$i=1;
						while ($row = mysqli_fetch_array($result))
						{
							echo'<tbody>';
							echo'<td>'. $i."</td>";
							echo'<th>'. $row['laikas']."</th>";
							echo'<th>'. $row['pavadinimas']."</th>";
							echo'<th>'. $row['kabinetas']."</th>";
							echo'<th>'. $row['vardas'] . " " .$row['pavarde']."</th>";
							$i=$i+1;
							echo'</tbody>';
						}
						echo '</table>';
						?>
							<div style="text-align: left;color:black">                   
                            <h3>Trečiadienis</h3>
							</div>
							<?php
							$query="SELECT laikas, pavadinimas, kabinetas, vardas, pavarde, id_Klase FROM `mokinys`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka`, `klase` 
						WHERE `klase`.`id_Klase` = $klase
						&& `klasespamoka`.fk_Klase = `mokinys`.fk_Klase 
						&& `klasespamoka`.`fk_Mokytojas` = `vartotojas`.`id_Vartotojas` 
						&& `pamokoslaikas`.`savaitesDiena` = 'Trečiadienis' 
						&& `pamokoslaikas`.`fk_KlasesPamoka` = `klasespamoka`.`id_KlasesPamoka` 
						&& klasespamoka.fk_Pamoka = pamoka.id_Pamoka ORDER BY laikas ";
							$result = $database->query($query);
							echo '<table>';
						echo'<th>'.'Nr.'."</th>";
						echo'<th>'.'Laikas'."</th>";
						echo'<th>'.'Pamoka'."</th>";
						echo'<th>'.'Kabinetas'."</th>";
						echo'<th>'.'Mokytojas'."</th>";
						$i=1;
						while ($row = mysqli_fetch_array($result))
						{
							echo'<tbody>';
							echo'<td>'. $i."</td>";
							echo'<th>'. $row['laikas']."</th>";
							echo'<th>'. $row['pavadinimas']."</th>";
							echo'<th>'. $row['kabinetas']."</th>";
							echo'<th>'. $row['vardas'] . " " .$row['pavarde']."</th>";
							$i=$i+1;
							echo'</tbody>';
						}
						echo '</table>';
						?>
							<div style="text-align: left;color:black">                   
                            <h3>Ketvirtadienis</h3>
							</div>
							<?php
							$query="SELECT laikas, pavadinimas, kabinetas, vardas, pavarde, id_Klase FROM `mokinys`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka`, `klase` 
						WHERE `klase`.`id_Klase` = $klase
						&& `klasespamoka`.fk_Klase = `mokinys`.fk_Klase 
						&& `klasespamoka`.`fk_Mokytojas` = `vartotojas`.`id_Vartotojas` 
						&& `pamokoslaikas`.`savaitesDiena` = 'Ketvirtadienis' 
						&& `pamokoslaikas`.`fk_KlasesPamoka` = `klasespamoka`.`id_KlasesPamoka` 
						&& klasespamoka.fk_Pamoka = pamoka.id_Pamoka ORDER BY laikas ";
							$result = $database->query($query);
							echo '<table>';
						echo'<th>'.'Nr.'."</th>";
						echo'<th>'.'Laikas'."</th>";
						echo'<th>'.'Pamoka'."</th>";
						echo'<th>'.'Kabinetas'."</th>";
						echo'<th>'.'Mokytojas'."</th>";
						$i=1;
						while ($row = mysqli_fetch_array($result))
						{
							echo'<tbody>';
							echo'<td>'. $i."</td>";
							echo'<th>'. $row['laikas']."</th>";
							echo'<th>'. $row['pavadinimas']."</th>";
							echo'<th>'. $row['kabinetas']."</th>";
							echo'<th>'. $row['vardas'] . " " .$row['pavarde']."</th>";
							$i=$i+1;
							echo'</tbody>';
						}
						echo '</table>';
						?>
							<div style="text-align: left;color:black">                   
                            <h3>Penktadienis</h3>
							</div>
							<?php
							$query="SELECT laikas, pavadinimas, kabinetas, vardas, pavarde, id_Klase FROM `mokinys`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka`, `klase` 
						WHERE `klase`.`id_Klase` = $klase
						&& `klasespamoka`.fk_Klase = `mokinys`.fk_Klase 
						&& `klasespamoka`.`fk_Mokytojas` = `vartotojas`.`id_Vartotojas` 
						&& `pamokoslaikas`.`savaitesDiena` = 'Penktadienis' 
						&& `pamokoslaikas`.`fk_KlasesPamoka` = `klasespamoka`.`id_KlasesPamoka` 
						&& klasespamoka.fk_Pamoka = pamoka.id_Pamoka ORDER BY laikas ";
							$result = $database->query($query);
							echo '<table>';
						echo'<th>'.'Nr.'."</th>";
						echo'<th>'.'Laikas'."</th>";
						echo'<th>'.'Pamoka'."</th>";
						echo'<th>'.'Kabinetas'."</th>";
						echo'<th>'.'Mokytojas'."</th>";
						$i=1;
						while ($row = mysqli_fetch_array($result))
						{
							echo'<tbody>';
							echo'<td>'. $i."</td>";
							echo'<th>'. $row['laikas']."</th>";
							echo'<th>'. $row['pavadinimas']."</th>";
							echo'<th>'. $row['kabinetas']."</th>";
							echo'<th>'. $row['vardas'] . " " .$row['pavarde']."</th>";
							$i=$i+1;
							echo'</tbody>';
						}
						echo '</table>';
						} 	else if ($mok != 0 & $klase == 0){
							?>
							<div style="text-align: left;color:black">                   
                            <h3>Pirmadienis</h3>
							</div>
							<?php
							$query="SELECT laikas, pavadinimas, kabinetas, klase, vardas, pavarde FROM `klase`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka` 
						WHERE `vartotojas`.id_Vartotojas = $mok 
                        && klasespamoka.fk_Mokytojas = vartotojas.id_Vartotojas
                        && klasespamoka.fk_Pamoka = pamoka.id_Pamoka
                        && pamokoslaikas.fk_KlasesPamoka = klasespamoka.id_KlasesPamoka
                        && `pamokoslaikas`.`savaitesDiena` = 'Pirmadienis'
					    ORDER BY laikas";
							$result = $database->query($query);
							echo '<table>';
						echo'<th>'.'Nr.'."</th>";
						echo'<th>'.'Laikas'."</th>";
						echo'<th>'.'Pamoka'."</th>";
						echo'<th>'.'Kabinetas'."</th>";
						echo'<th>'.'Klasė'."</th>";
						$i=1;
						while ($row = mysqli_fetch_array($result))
						{
							echo'<tbody>';
							echo'<td>'. $i."</td>";
							echo'<th>'. $row['laikas']."</th>";
							echo'<th>'. $row['pavadinimas']."</th>";
							echo'<th>'. $row['kabinetas']."</th>";
							echo'<th>'. $row['klase'] ."</th>";
							$i=$i+1;
							echo'</tbody>';
						}
						echo '</table>';
						?>
							<div style="text-align: left;color:black">                   
                            <h3>Antradienis</h3>
							</div>
							<?php
							$query="SELECT laikas, pavadinimas, kabinetas, klase, vardas, pavarde FROM `klase`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka` 
						WHERE `vartotojas`.id_Vartotojas = $mok 
                        && klasespamoka.fk_Mokytojas = vartotojas.id_Vartotojas
                        && klasespamoka.fk_Pamoka = pamoka.id_Pamoka
                        && pamokoslaikas.fk_KlasesPamoka = klasespamoka.id_KlasesPamoka
                        && `pamokoslaikas`.`savaitesDiena` = 'Antradienis'
					    ORDER BY laikas";
							$result = $database->query($query);
							echo '<table>';
						echo'<th>'.'Nr.'."</th>";
						echo'<th>'.'Laikas'."</th>";
						echo'<th>'.'Pamoka'."</th>";
						echo'<th>'.'Kabinetas'."</th>";
						echo'<th>'.'Klasė'."</th>";
						$i=1;
						while ($row = mysqli_fetch_array($result))
						{
							echo'<tbody>';
							echo'<td>'. $i."</td>";
							echo'<th>'. $row['laikas']."</th>";
							echo'<th>'. $row['pavadinimas']."</th>";
							echo'<th>'. $row['kabinetas']."</th>";
							echo'<th>'. $row['klase'] ."</th>";
							$i=$i+1;
							echo'</tbody>';
						}
						echo '</table>';
						?>
							<div style="text-align: left;color:black">                   
                            <h3>Trečiadienis</h3>
							</div>
							<?php
							$query="SELECT laikas, pavadinimas, kabinetas, klase, vardas, pavarde FROM `klase`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka` 
						WHERE `vartotojas`.id_Vartotojas = $mok 
                        && klasespamoka.fk_Mokytojas = vartotojas.id_Vartotojas
                        && klasespamoka.fk_Pamoka = pamoka.id_Pamoka
                        && pamokoslaikas.fk_KlasesPamoka = klasespamoka.id_KlasesPamoka
                        && `pamokoslaikas`.`savaitesDiena` = 'Trečiadienis'
					    ORDER BY laikas";
							$result = $database->query($query);
							echo '<table>';
						echo'<th>'.'Nr.'."</th>";
						echo'<th>'.'Laikas'."</th>";
						echo'<th>'.'Pamoka'."</th>";
						echo'<th>'.'Kabinetas'."</th>";
						echo'<th>'.'Klasė'."</th>";
						$i=1;
						while ($row = mysqli_fetch_array($result))
						{
							echo'<tbody>';
							echo'<td>'. $i."</td>";
							echo'<th>'. $row['laikas']."</th>";
							echo'<th>'. $row['pavadinimas']."</th>";
							echo'<th>'. $row['kabinetas']."</th>";
							echo'<th>'. $row['klase'] ."</th>";
							$i=$i+1;
							echo'</tbody>';
						}
						echo '</table>';
						?>
							<div style="text-align: left;color:black">                   
                            <h3>Ketvirtadienis</h3>
							</div>
							<?php
							$query="SELECT laikas, pavadinimas, kabinetas, klase, vardas, pavarde FROM `klase`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka` 
						WHERE `vartotojas`.id_Vartotojas = $mok 
                        && klasespamoka.fk_Mokytojas = vartotojas.id_Vartotojas
                        && klasespamoka.fk_Pamoka = pamoka.id_Pamoka
                        && pamokoslaikas.fk_KlasesPamoka = klasespamoka.id_KlasesPamoka
                        && `pamokoslaikas`.`savaitesDiena` = 'Ketvirtadienis'
					    ORDER BY laikas";
							$result = $database->query($query);
							echo '<table>';
						echo'<th>'.'Nr.'."</th>";
						echo'<th>'.'Laikas'."</th>";
						echo'<th>'.'Pamoka'."</th>";
						echo'<th>'.'Kabinetas'."</th>";
						echo'<th>'.'Klasė'."</th>";
						$i=1;
						while ($row = mysqli_fetch_array($result))
						{
							echo'<tbody>';
							echo'<td>'. $i."</td>";
							echo'<th>'. $row['laikas']."</th>";
							echo'<th>'. $row['pavadinimas']."</th>";
							echo'<th>'. $row['kabinetas']."</th>";
							echo'<th>'. $row['klase'] ."</th>";
							$i=$i+1;
							echo'</tbody>';
						}
						echo '</table>';
						?>
							<div style="text-align: left;color:black">                   
                            <h3>Penktadienis</h3>
							</div>
							<?php
							$query="SELECT laikas, pavadinimas, kabinetas, klase, vardas, pavarde FROM `klase`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka` 
						WHERE `vartotojas`.id_Vartotojas = $mok 
                        && klasespamoka.fk_Mokytojas = vartotojas.id_Vartotojas
                        && klasespamoka.fk_Pamoka = pamoka.id_Pamoka
                        && pamokoslaikas.fk_KlasesPamoka = klasespamoka.id_KlasesPamoka
                        && `pamokoslaikas`.`savaitesDiena` = 'Penktadienis'
					    ORDER BY laikas";
							$result = $database->query($query);
							echo '<table>';
						echo'<th>'.'Nr.'."</th>";
						echo'<th>'.'Laikas'."</th>";
						echo'<th>'.'Pamoka'."</th>";
						echo'<th>'.'Kabinetas'."</th>";
						echo'<th>'.'Klasė'."</th>";
						$i=1;
						while ($row = mysqli_fetch_array($result))
						{
							echo'<tbody>';
							echo'<td>'. $i."</td>";
							echo'<th>'. $row['laikas']."</th>";
							echo'<th>'. $row['pavadinimas']."</th>";
							echo'<th>'. $row['kabinetas']."</th>";
							echo'<th>'. $row['klase'] ."</th>";
							$i=$i+1;
							echo'</tbody>';
						}
						echo '</table>';
						}	else if ($mok == 0 & $klase == 0){
							?>
								<div class="alert">
								<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
								Nepasirinkta klasė arba mokytojas
								</div>
								<?php
								}
					     	else if ($mok != 0 & $klase != 0){
								?>
								<div class="alert">
								<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
								Pasirinkite tik klasę arba tik mokytoją
								</div>
								<?php
							}								
						}

    echo "<tr><td>";
    include("../include/footer.php");
    echo "</td></tr>";
    ?>
    </table>       
    </body>
    </html>
    <?php
}
?>