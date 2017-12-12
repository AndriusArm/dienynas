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
                        $monday = date("Y-m-d",strtotime('monday this week'));
                        $tuesday = date("Y-m-d",strtotime('tuesday this week'));
                        $wednesday = date("Y-m-d",strtotime('wednesday this week'));
                        $thursday = date("Y-m-d",strtotime('thursday this week'));                            
                        $friday = date("Y-m-d",strtotime('friday this week'));
                        ?>                           
                        <br> 
                        <div style="text-align: center;color:green">                   
                            <h1>Mano tvarkaraštis</h1>
                        </div><br>
                        <div style="text-align: left;color:black">                   
                            <h3>Pirmadienis</h3>
                        </div>
                            <?php
                            scheduleDayTeacher($monday, 'Pirmadienis');
                            ?>
                            <br>
                        <div style="text-align: left;color:black">                   
                            <h3>Antradienis</h3>
                        </div>
                            <?php
                            scheduleDayTeacher($tuesday, 'Antradienis');
                            ?>
                            <br>
                        <div style="text-align: left;color:black">                   
                            <h3>Trečiadienis</h3>
                        </div>
                            <?php
                            scheduleDayTeacher($wednesday, 'Treciadienis');
                            ?>
                            <br>
                        <div style="text-align: left;color:black">                   
                            <h3>Ketvirtadienis</h3>
                        </div>
                            <?php
                            scheduleDayTeacher($thursday, 'Ketvirtadienis');
                            ?>
                            <br>
                        <div style="text-align: left;color:black">                   
                            <h3>Penktadienis</h3>
                        </div>
                            <?php
                            scheduleDayTeacher($friday, 'Penktadienis');                         
                            echo "<br>";
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