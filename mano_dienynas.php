<?php
include("include/session.php");
if ($session->logged_in) {
    ?>
	<head>  
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
                        ?>                          
                        <br> 
                        <div style="text-align: center;color:green">     						
                            <h1>Mano dienynas</h1>
				<div class="container">
                <table class="table table-bordered"> 
                    <thead>
                    <tr>
			<th rowspan="2">Nr.</th>
                        <th rowspan="2">Pamoka</th>
                        <th colspan="<?php echo $daysInMonth + 1?>">Diena</th>
                    </tr>
                    </thead>
 
                    <tbody>
                        <tr>
                            <td><?php echo ""; ?></td>
                            <td><?php echo ""; ?></td>
                <?php
                   //for($i = 1; $i <= 30; $i++)

                   for($i = 1; $i <= $daysInMonth; $i++){
                       ?><td><?php echo $i; ?></td><?php
                   }
                   ?></tr><?php
                        $userID = $session->userinfo["id_Vartotojas"];
                        $markQuery = "SELECT pazymys.verte, lankomumas.data, pamoka.pavadinimas FROM pazymys, lankomumas, pamoka WHERE `pazymys`.`fk_KlasesPamoka` = `lankomumas`.`fk_KlasesPamoka` and lankomumas.fk_Mokinys = 3 and pamoka.id_Pamoka = pazymys.id_Pazymys
order by pamoka.pavadinimas, lankomumas.data ASC";
                        $no=1;
                        $result = $database->query($markQuery);
			$lastSubject = "";
                        while ($row = mysqli_fetch_array($result)){
                            if ($row['pavadinimas'] != $lastSubject && $lastSubject != ""){
                                echo $lastSubject;
                                echo "<tr><td>". $no++. "</td><td>$lastSubject</td>";
                                for ($i = 1; $i <= $daysInMonth; $i++){
                                    if(array_key_exists($i, $grades))
                                      echo "<td>$grades[$i]</td>";
                                    else
                                      echo "<td></td>";
                                }
                                echo "</tr>";
                                for ($i = 1; $i <= $daysInMonth; $i++)
                                  unset($grades[$i]);
                            }
                            $day = date('j', strtotime($row['data']));
                            $grades[$day] = $row['verte'];
                            $lastSubject = $row['pavadinimas'];
                        } 
                        echo "<tr><td>". $no++. "</td><td>$lastSubject</td>";
                        for ($i = 1; $i <= $daysInMonth; $i++){
                            if(array_key_exists($i, $grades))
                              echo "<td>$grades[$i]</td>";
                            else
                              echo "<td></td>";
                        }
                        echo "</tr>";
                       ?>
                    </tbody>
                </table>
                <?php
                    include("include/footer.php");
                ?>
                </td></tr>      
            </table>
            </div>
        </body>
    </html>
    <?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis  
} else {
    header("Location: index.php");
}
?>