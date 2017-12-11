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