<?php

function fillGrades($row, $userID, $lastSubject, $lastSubjectID, $no, $daysInMonth, $grades){
    global $database;
    $absentQuery = "SELECT arBuvo, data FROM mokinys, klasespamoka, lankomumas, pamoka "
            . "     WHERE mokinys.id_Vartotojas = $userID AND lankomumas.fk_Mokinys = $userID "
            . "     AND lankomumas.fk_Klasespamoka = klasespamoka.id_Klasespamoka AND klasespamoka.fk_pamoka = $lastSubjectID GROUP BY data";
    $rezAbsent = $database->query($absentQuery);
    while ($row2 = mysqli_fetch_array($rezAbsent)){
        if ($row2['arBuvo'] == 0)
            $grades[date('j', strtotime($row2['data']))] = "N";
    }
    echo "<tr><td>". $no++. "</td><td>$lastSubject</td>";
    for ($i = 1; $i <= $daysInMonth; $i++){
        if(array_key_exists($i, $grades))
            echo "<td>$grades[$i]</td>";
        else
            echo "<td></td>";
    }
    echo "</tr>";
}