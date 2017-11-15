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
                        ?>                          
                        <br> 
                        <div style="text-align: center;color:green">     						
                            <h1>Mano dienynas</h1>
						<?php
				
                ?>
				<div class="container">
                <table class="table table-bordered">
 
                    <thead>
                    <tr>
						<th rowspan="2">Nr.</th>
                        <th rowspan="2">Pamoka</th>
                        <th colspan="<?php echo 30?>">Diena</th>
                    </tr>
                    </thead>
 
                    <tbody>
                    <?php
 
                   ?><tr><?php
                       ?><td><?php echo ""; ?></td><?php
					    ?><td><?php echo ""; ?></td><?php
                   for($i = 1; $i <= 30; $i++)
                   {
                       ?><td><?php echo $i; ?></td><?php
                   }
                   ?></tr><?php
					$k = $session->userinfo["id_Vartotojas"];
					$query2 = "SELECT * FROM `pamoka`, `mokinys_pamoka` WHERE `mokinys_pamoka`.fk_Mokinys=$k && `mokinys_pamoka`.fk_Pamoka=id_Pamoka";
					$j=1;
					$result = $database->query($query2);
					
                        while ($row = mysqli_fetch_array($result))
                        {
                            ?><tr><?php
							?><td><?php echo $j; ?></td><?php
							$j=$j+1;
							?><td><?php echo $row['pavadinimas']; ?></td><?php
							$id=$row['id_Pamoka'];
							$query3 = "SELECT * FROM `irasas` WHERE fk_Mokinys=$k && fk_Pamoka=$id";
							$result2 = $database->query($query3);
							$ii = 0;
							while ($row = mysqli_fetch_array($result2))
							{
								?><td><?php echo $row['pazymys']; ?></td><?php
								$date = DateTime::createFromFormat("Y-m-d", $row['data']);
								$date->format("d");
								$ii=$ii+1;
							}
                           for($i = $ii+1; $i <= 30; $i++)
                           {
                               ?><td><?php
                                  
                                       
                                    echo "";
                                       
                                  
                               ?></td><?php
                           }
                           ?></tr><?php

                       }
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