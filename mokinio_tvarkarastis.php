<?php
include("include/session.php");
if ($session->logged_in) {
    ?>
    <html>
	<style>
	table {
    border-collapse: collapse;
}

th, td {
    padding: 8px;
    text-align: center;
    border-bottom: 1px solid #ddd;
	</style>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Mano tvarkaraštis</title>
            <link href="include/styles2.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
            <table class="center"><tr><td>
                        <img src="pictures/top.jpg"/>
                    </td></tr><tr><td> 
                        <?php
                        include("include/meniu.php");
                        ?>                           
                        <br> 
                        <div style="text-align: center;color:green">                   
                            <h1>Mano tvarkaraštis</h1>
						</div><br>
						<div style="text-align: left;color:black">                   
                            <h3>Pirmadienis</h3>
						</div>
						<?php
						$vart = $session->userinfo["id_Vartotojas"];
						$query2 = "SELECT laikas, pavadinimas, kabinetas, vardas, pavarde FROM `mokinys`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka` 
						WHERE `mokinys`.id_Vartotojas = 3 
						&& `klasespamoka`.fk_Klase = `mokinys`.fk_Klase 
						&& `klasespamoka`.`fk_Mokytojas` = `vartotojas`.`id_Vartotojas` 
						&& `pamokoslaikas`.`savaitesDiena` = 'Pirmadienis' 
						&& `pamokoslaikas`.`fk_KlasesPamoka` = `klasespamoka`.`id_KlasesPamoka` 
						&& klasespamoka.fk_Pamoka = pamoka.id_Pamoka ORDER BY laikas ";
						$result = $database->query($query2);
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
						<br>
							<div style="text-align: left;color:black">                   
                            <h3>Antradienis</h3>
						</div>
						<?php
						$vart = $session->userinfo["id_Vartotojas"];
						$query2 = "SELECT laikas, pavadinimas, kabinetas, vardas, pavarde FROM `mokinys`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka` 
						WHERE `mokinys`.id_Vartotojas = 3 
						&& `klasespamoka`.fk_Klase = `mokinys`.fk_Klase 
						&& `klasespamoka`.`fk_Mokytojas` = `vartotojas`.`id_Vartotojas` 
						&& `pamokoslaikas`.`savaitesDiena` = 'Antradienis' 
						&& `pamokoslaikas`.`fk_KlasesPamoka` = `klasespamoka`.`id_KlasesPamoka` 
						&& klasespamoka.fk_Pamoka = pamoka.id_Pamoka ORDER BY laikas ";
						$result = $database->query($query2);
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
						<br>
							<div style="text-align: left;color:black">                   
                            <h3>Trečiadienis</h3>
						</div>
						<?php
						$vart = $session->userinfo["id_Vartotojas"];
						$query2 = "SELECT laikas, pavadinimas, kabinetas, vardas, pavarde FROM `mokinys`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka` 
						WHERE `mokinys`.id_Vartotojas = 3 
						&& `klasespamoka`.fk_Klase = `mokinys`.fk_Klase 
						&& `klasespamoka`.`fk_Mokytojas` = `vartotojas`.`id_Vartotojas` 
						&& `pamokoslaikas`.`savaitesDiena` = 'Trečiadienis' 
						&& `pamokoslaikas`.`fk_KlasesPamoka` = `klasespamoka`.`id_KlasesPamoka` 
						&& klasespamoka.fk_Pamoka = pamoka.id_Pamoka ORDER BY laikas ";
						$result = $database->query($query2);
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
						<br>
							<div style="text-align: left;color:black">                   
                            <h3>Ketvirtadienis</h3>
						</div>
						<?php
						$vart = $session->userinfo["id_Vartotojas"];
						$query2 = "SELECT laikas, pavadinimas, kabinetas, vardas, pavarde FROM `mokinys`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka` 
						WHERE `mokinys`.id_Vartotojas = $vart 
						&& `klasespamoka`.fk_Klase = `mokinys`.fk_Klase 
						&& `klasespamoka`.`fk_Mokytojas` = `vartotojas`.`id_Vartotojas` 
						&& `pamokoslaikas`.`savaitesDiena` = 'Ketvirtadienis' 
						&& `pamokoslaikas`.`fk_KlasesPamoka` = `klasespamoka`.`id_KlasesPamoka` 
						&& klasespamoka.fk_Pamoka = pamoka.id_Pamoka ORDER BY laikas ";
						$result = $database->query($query2);
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
						<br>
						<div style="text-align: left;color:black">                   
                        <h3>Penktadienis</h3>
						</div>
						<?php
						$vart = $session->userinfo["id_Vartotojas"];
						$query2 = "SELECT laikas, pavadinimas, kabinetas, vardas, pavarde FROM `mokinys`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka` 
						WHERE `mokinys`.id_Vartotojas = 3 
						&& `klasespamoka`.fk_Klase = `mokinys`.fk_Klase 
						&& `klasespamoka`.`fk_Mokytojas` = `vartotojas`.`id_Vartotojas` 
						&& `pamokoslaikas`.`savaitesDiena` = 'Penktadienis' 
						&& `pamokoslaikas`.`fk_KlasesPamoka` = `klasespamoka`.`id_KlasesPamoka` 
						&& klasespamoka.fk_Pamoka = pamoka.id_Pamoka ORDER BY laikas ";
						$result = $database->query($query2);
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
                        <?php
                        include("include/footer.php");
                        ?>
                    </td></tr>      
            </table>
        </body>
    </html>
    <?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis  
} else {
    header("Location: index.php");
}
?>