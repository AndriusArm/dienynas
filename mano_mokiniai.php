<?php
include("include/session.php");
include("include/functions.php");
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
    border-bottom: 1px solid #ddd;}

table.center{
    position: absolute;
    background-color: #999966;   
    z-index: -5;
    width:90%;
    left:5%;
    right:5%;
}

.table tr:hover {
  background-color: #ffa;
}

.table td, .table th {
  position: relative;
}

.table td:hover::after,
.table th:hover::after {
  content: "";
  position: absolute;
  background-color: #ffa;
  left: 0;
  top: -5000px;
  height: 10000px;
  width: 100%;
  z-index: -1;
}
	</style>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Mano dienynas</title>
            <link href="include/styles2.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
            <table class="center"><tr><td>
                        <img src="pictures/top.jpg"/>
                    </td></tr><tr><td> 
                        <?php
                        include("include/meniu.php");
                        $currentMonth = date("m");
                        $currentYear = date("Y");
                        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
                        //TODO show by month
                        //$activeMonth
                        $startDate = date("Y-m-01");
                        $endDate = date("Y-m-t");
                        $grades =[]; 
                        
                        if (isset ($_POST['pazymys'])){  
                            //var_dump($_POST);
                            //var_dump($_SESSION);
                            //var_dump($session);
                            $pamok = $_POST['pamok'];
                            $uid = $session->userinfo['id_Vartotojas'];
                            $kl = $_SESSION['klase'];
                            $inGr = $_SESSION['init'];
                            $klasQuery = "SELECT `id_Klasespamoka` FROM `klasespamoka` WHERE `fk_Klase` = $kl  and `fk_Pamoka` = $pamok and `fk_Mokytojas` = $uid";
                            $klasRez = $database->query($klasQuery);
                            while($row = mysqli_fetch_array($klasRez))
                                $klasPamok = $row['id_Klasespamoka'];
                            foreach($_POST as $key => $value){
                                $comma = strpos($key, ",");
                                if ($comma !== FALSE){
                                    $mok = substr($key, 0, $comma);
                                    $day = substr($key, $comma + 1);
                                    $date = date("Y-m-$day");
                                    if (preg_match('/([0-9]|10)/', $value) || $value == ''){
                                        if(array_key_exists($day, $inGr[$mok])){
                                            if($value != $inGr[$mok][$day]){
                                                //update pazymys
                                                if($value == ''){
                                                    $pazymys = "UPDATE `pazymys` SET `verte`=null WHERE `fk_Mokinys`=$mok AND `fk_KlasesPamoka`=$klasPamok AND `data` = '$date'";   
                                                }else{
                                                    $pazymys = "UPDATE `pazymys` SET `verte`='$value' WHERE `fk_Mokinys`=$mok AND `fk_KlasesPamoka`=$klasPamok AND `data` = '$date'";
                                                }
                                                $database->query($pazymys);
                                            }
                                        }else if ($value != ''){                          
                                            $pazymys = "INSERT INTO `pazymys`(`verte`, `tipas`, `fk_Mokinys`, `fk_KlasesPamoka`, `data`) VALUES ($value,'',$mok,$klasPamok,'$date')";
                                            $database->query($pazymys);

                                        }
                                    }
                                    if (preg_match('/[nN]{1}/', $value) || $value ==''){
                                        if(array_key_exists($day, $inGr[$mok])){
                                            if($value != $inGr[$mok][$day]){
                                                //update lankomumas
                                                if ($value == ''){
                                                    $lankomumas = "DELETE from `lankomumas` WHERE `fk_Mokinys`=$mok AND `fk_KlasesPamoka`=$klasPamok AND `data`= '$date'";
                                                }else{
                                                    $lankomumas = "UPDATE `lankomumas` SET `arBuvo`='0' WHERE `fk_Mokinys`=$mok AND `fk_KlasesPamoka`=$klasPamok AND `data`= '$date'";
                                                }   
                                                $database->query($lankomumas);
                                            }
                                        }else if ($value != ''){
                                            //insert lankomumas
                                            $lankomumas = "INSERT INTO `lankomumas`(`data`, `arBuvo`, `fk_KlasesPamoka`, `fk_Mokinys`) VALUES ('$date','0',$klasPamok,$mok)";
                                            $database->query($lankomumas);
                                        }
                                    }    
                                }
                            }
                            //if(true){                        
                            //}else{
   
                           //echo "<div class=\"alert\">"
                           //     ."<span class=\"closebtn\" onclick=\"this.parentElement.style.display=\"none\";\">&times;</span>" 
                           //     ."Neįvesta informacija"
                           //    ."</div>";
                        }
                        ?>                           
                        <br> 
                        <div style="text-align: center;color:green">                   
                            <h1>Mano dienynas</h1>
                            <form action="" method="post">
                            <fieldset>
                                <legend>Mokinių sąrašas</legend>
                                <?php
                                echo'Pasirinkite pamoką ';
                                $userID = $session->userinfo["id_Vartotojas"];
                                $query = "SELECT pamoka.pavadinimas, pamoka.id_pamoka,klasespamoka.fk_Klase, klase.klase from pamoka, klasespamoka, klase WHERE klasespamoka.fk_Mokytojas= $userID and klasespamoka.fk_Pamoka = pamoka.id_Pamoka and klase.id_Klase = klasespamoka.fk_Klase ";

                                echo'<select name="pam">';
                                echo'<option value="0">Pasirinkite...</option>';
                                $mok = $database->query($query);                                       
                                while ( $row=mysqli_fetch_assoc($mok)) {
                                    if (isset($_POST['pam'])){
                                        if ($_POST['pam'] == "[".$row['id_pamoka'].",".$row['fk_Klase']."]")
                                            echo "<option selected=\"\" value='[".$row['id_pamoka'].",".$row['fk_Klase']."]'>".$row['pavadinimas']." ".$row['klase']."</option>"; 
                                        else
                                            echo "<option value='[".$row['id_pamoka'].",".$row['fk_Klase']."]'>".$row['pavadinimas']." ".$row['klase']."</option>";
                                    }   
                                    else
                                        echo "<option value='[".$row['id_pamoka'].",".$row['fk_Klase']."]'>".$row['pavadinimas']." ".$row['klase']."</option>";
                                }
                                echo"</select>";
                                if (isset ($_POST['pam'])){ 
                                    $pam = $_POST['pam'];
                                    $str = strpos($pam, ',');
                                    $klase = substr($pam, $str + 1, -1);
                                    $_SESSION['klase'] = $klase;
                                    $pam = substr($pam, 1, $str - 1);
                                    
                                    if($pam != 0){

                                    $query2 = "SELECT vardas, pavarde, klase, `vartotojas`.`id_Vartotojas` FROM `vartotojas`, `mokinys`, `klasespamoka`, klase WHERE `mokinys`.fk_Klase = $klase AND klasespamoka.fk_Klase = $klase AND klasespamoka.fk_Pamoka = $pam AND vartotojas.id_Vartotojas = mokinys.id_Vartotojas and klase.id_Klase = mokinys.fk_Klase group by id_Vartotojas";
                                    $result = $database->query($query2);
                                    $query3="SELECT pavadinimas FROM `pamoka` WHERE id_Pamoka=$pam";
                                    $p = $database->query($query3);
                                    $row=mysqli_fetch_assoc($p);

                                    echo "<h2>Pamoka: " .$row['pavadinimas']."</h2>";
                                    $colspan = $daysInMonth + 1;
                                    echo "<table class=\"table table-bordered\"> "
                                       ." <thead>"
                                        ."<tr>"
                                            ."<th rowspan=\"2\">Nr.</th>"
                                            ."<th rowspan=\"2\">Mokinys</th>"
                                            ."<th colspan=\"$colspan\">Diena</th>"
                                        ."</tr>"
                                        ."</thead>"
                                        ."<tbody>"
                                            ."<tr>"
                                            ."<td></td>"
                                             ."<td></td>";

                                       for($i = 1; $i <= $daysInMonth; $i++){
                                           echo "<td>$i</td>";
                                       }
                                       echo "</tr>";
                                       $i=1;
                                       ?>
                                        <form action="" method="post">
                                        <?php
                                    while ($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        $pamok=$pam;
                                        echo'<input type=\'hidden\' name=\'pamok\' value=\''.$pamok.'\' />';
                                        echo'<td>'. $i."</td>";
                                        echo'<td>'. $row['vardas'].' '.$row['pavarde']."</td>";
                                        echo'<input type=\'hidden\' name=\'id\' value=\''.$row['id_Vartotojas'].'\' />';
                                        fillGradesNoHTML($row['id_Vartotojas'], $pamok, $grades, $startDate, $endDate);
                                        for($j = 1; $j <= $daysInMonth; $j++){
                                            if (array_key_exists($j, $grades)){
                                                echo "<td><input class=\"pazymys\" name=".$row['id_Vartotojas'].",$j value=\"$grades[$j]\"></td>";
                                            }else{
                                                echo "<td><input class=\"pazymys\" name=".$row['id_Vartotojas'].",$j></td>";
                                            }
                                        }
                                        $initialGrades[$row['id_Vartotojas']] = $grades;
                                        for ($k = 1; $k <= $daysInMonth; $k++){                                            
                                            unset($grades[$k]);
                                        }
                                            
                                        echo "</tr>";                                                                           
                                        $i=$i+1;                                  
                                    }
                                    $_SESSION['init'] = $initialGrades;
                                    echo'</tbody>';
                                    echo "<input name=\"pazymys\" type=\"submit\" value=\"Išsaugoti\"</td>";
                                    echo "</form>";
                                    echo '</table>'; 
                                    } 	else {
                                            ?>
                                        <div class="alert">
                                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                        Nepasirinkta pamoka
                                        </div>
                                        <?php
                                        }
                            }
                                    ?>
                            </fieldset>
                            <p><input type="submit" class="submit" name="submit" value="Rodyti sąrašą"></p>
                            </form>               
                        </div> 
                        <br>                
                <tr><td>
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