<?php

function fillGrades($row, $userID, $lastSubject, $lastSubjectID, $no, $daysInMonth, $grades){
    global $database;
    $absentQuery = "SELECT arBuvo, data FROM mokinys, klasespamoka, lankomumas, pamoka "
                . "WHERE mokinys.id_Vartotojas = $userID "
                . "AND lankomumas.fk_Mokinys = $userID "
                . "AND lankomumas.fk_Klasespamoka = klasespamoka.id_Klasespamoka "
                . "AND klasespamoka.fk_pamoka = $lastSubjectID GROUP BY data";
    $rezAbsent = $database->query($absentQuery);
    if ($rezAbsent){
        while ($row2 = mysqli_fetch_array($rezAbsent)){
            if ($row2['arBuvo'] == 0)
                $grades[date('j', strtotime($row2['data']))] = "N";
        }
    }
    echo "<tr><td>". $no. "</td><td>$lastSubject</td>";
    for ($i = 1; $i <= $daysInMonth; $i++){
        if(array_key_exists($i, $grades))
            echo "<td>$grades[$i]</td>";
        else
            echo "<td></td>";
    }
    echo "</tr>";
}

function fillGradesNoHTML($userID, $subjectID, &$grades, $fromDate, $toDate){
    global $database;
    $markQuery = "SELECT pazymys.verte, pazymys.data "
                . "FROM klasespamoka, pamoka, mokinys, pazymys "
                . "where mokinys.id_Vartotojas = $userID "
                . "and pamoka.id_Pamoka = klasespamoka.fk_Pamoka "
                . "and pazymys.fk_klasespamoka = klasespamoka.id_klasespamoka "
                . "AND mokinys.id_Vartotojas = pazymys.fk_Mokinys "
                . "AND pazymys.data < '$toDate' "
                . "AND '$fromDate' < pazymys.data "
                . "AND pamoka.id_Pamoka = $subjectID "
                . "ORDER BY pamoka.pavadinimas, pazymys.data ASC";
    $result = $database->query($markQuery);
    while ($row = mysqli_fetch_array($result)){
        $day = date('j', strtotime($row['data']));
        $grades[$day] = $row['verte'];
    }
    $absentQuery = "SELECT arBuvo, data FROM mokinys, klasespamoka, lankomumas, pamoka "
                . "WHERE mokinys.id_Vartotojas = $userID "
                . "AND lankomumas.fk_Mokinys = $userID "
                . "AND lankomumas.fk_Klasespamoka = klasespamoka.id_Klasespamoka "
                . "AND klasespamoka.fk_pamoka = $subjectID GROUP BY data ORDER BY id_lankomumas DESC";
    $rezAbsent = $database->query($absentQuery);
    if ($rezAbsent){
        while ($row2 = mysqli_fetch_array($rezAbsent)){
            if ($row2['arBuvo'] == 0){
                $day = date('j', strtotime($row2['data']));
                $grades[$day] = "N";
            }               
        }
    }
}

function scheduleDayStudent($weekDay, $date){
    global $database;
    global $session;
    
    $vart = $session->userinfo["id_Vartotojas"];
        $query2 = "SELECT laikas, pavadinimas, kabinetas, vardas, pavarde, id_KlasesPamoka FROM `mokinys`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka` 
        WHERE `mokinys`.id_Vartotojas = $vart 
        && `klasespamoka`.fk_Klase = `mokinys`.fk_Klase 
        && `klasespamoka`.`fk_Mokytojas` = `vartotojas`.`id_Vartotojas` 
        && `pamokoslaikas`.`savaitesDiena` = '$weekDay' 
        && `pamokoslaikas`.`fk_KlasesPamoka` = `klasespamoka`.`id_KlasesPamoka` 
        && klasespamoka.fk_Pamoka = pamoka.id_Pamoka ORDER BY laikas ";
        $result = $database->query($query2);
        echo '<table>';
        //echo '<thead>';
        echo"<tr>\r\n";
        echo'<th>'.'Nr.'."</th>\r\n";
        echo'<th>'.'Laikas'."</th>\r\n";
        echo'<th>'.'Pamoka'."</th>\r\n";
        echo'<th>'.'Kabinetas'."</th>\r\n";
        echo'<th>'.'Mokytojas'."</th>\r\n";
        echo"</tr>\r\n";
        //echo '</thead>';
        $i=1;
        //echo'<tbody>';
        while ($row = mysqli_fetch_array($result))
        {         
            echo '<tr>';
            echo'<td>'. $i."</td>\r\n";
            echo'<td>'. $row['laikas']."</td>\r\n";
            $entry = getHomeWorkID($date, $row['id_KlasesPamoka']);
            if ($entry){
                echo '<td><a href="tvarkarastisRead.php?id='.$entry['id_Irasas'].'">'. $row['pavadinimas']."</a></td>\r\n";
            }else{
                echo'<td>'. $row['pavadinimas']."</td>\r\n";
            }
            echo'<td>'. $row['kabinetas']."</td>\r\n";
            echo'<td>'. $row['vardas'] . " " .$row['pavarde']."</td>\r\n";
            $i=$i+1;
            echo '</tr>';
        }
        //echo'</tbody>';
        echo '</table>';
}

function scheduleDayTeacher($date, $weekday){
    global $database;
    global $session;
    
    
    $vart = $session->userinfo["id_Vartotojas"];
    $query2 =   "SELECT laikas, pavadinimas, kabinetas, klase, vardas, pavarde, `id_KlasesPamoka` FROM `klase`, `klasespamoka`, `vartotojas`, `pamokoslaikas`, `pamoka`
                WHERE `vartotojas`.id_Vartotojas = $vart 
                && klasespamoka.fk_Mokytojas = vartotojas.id_Vartotojas
                && klasespamoka.fk_Pamoka = pamoka.id_Pamoka
                && pamokoslaikas.fk_KlasesPamoka = klasespamoka.id_KlasesPamoka
                && `pamokoslaikas`.`savaitesDiena` = '$weekday'
				&& `klase`.`id_Klase` = `Klasespamoka`.`fk_Klase`
                ORDER BY laikas";
    $result = $database->query($query2);
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
            echo'<td>'. $row['laikas']."</td>";
            echo'<td><a href=tvarkarastisInsert.php?date='.$date.'&id='.$row['id_KlasesPamoka'].'>'. $row['pavadinimas']."</a></td>";
            echo'<td>'. $row['kabinetas']."</td>";
            echo'<td>'. $row['klase'] ."</td>";
            $i=$i+1;
            echo'</tbody>';
    }
    echo '</table>';
}

function getHomeWorkID($date, $klasesPamoka){
    global $database;
    
    $query = "SELECT id_Irasas FROM `irasas` WHERE irasas.fk_Klasespamoka = $klasesPamoka AND `data`= '$date' GROUP BY id_Irasas";
    $result = $database->query($query);
    if(mysqli_num_rows($result) == 0){
        return false;
    }else{
        return mysqli_fetch_array($result);
    }            
}

function getHomeWork($id){
    global $database;

    if(preg_match('/^[0-9]/', $id) == 0){
        header("Location: index.php");
        die();
    }
    $query = "SELECT `pamokosTema`, `klasesDarbas`, `namuDarbai` FROM `irasas` WHERE `irasas`.id_Irasas = $id";
    $result = $database->query($query);
    if(mysqli_num_rows($result) == 0){
        return false;
    }else{
        return mysqli_fetch_array($result);
    }            
}

function getHomeWorkByDateFK($date, $fk){
    global $database;
    
    $query = "SELECT `pamokosTema`, `klasesDarbas`, `namuDarbai`, `id_Irasas` FROM `irasas` WHERE `data`='$date' AND `fk_KlasesPamoka` = '$fk'";
    $result = $database->query($query);
    if(mysqli_num_rows($result) == 0){
        return false;
    }else{
        return mysqli_fetch_array($result);
    } 
}