<?php
include("../include/session.php");

$selectOption = '0';
if (!$session->isAdministratorius()) {
    header("Location: ../index.php");
} else { //Jei administratorius
    ?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Administratoriaus sąsaja</title>
            <link href="../include/styles2.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </head>  
        <body>
            <table class="center"><tr><td>
                        <img src="../pictures/top.jpg"/>
                        </td></tr><tr><td> 
                        <?php
                        $_SESSION['path'] = '../';
                        include("../include/meniu.php");
                        ?>
                        <br> 

                        <tr><td> 
                        <fieldset>
                        <div class="row">
        				<div class="col-md-12">
           				<div class="panel-body">
                      

						<legend></legend>
						<form action="" method="post">
							<?php
							  if(isset($_POST['save2']))
							{
							    $sql = "INSERT INTO klase (klase)
							    VALUES ('".$_POST["klasesPavadinimas"]."')";
							    $result = $database->query($sql);
							}
							?>

							<form action="" method="post"> 
							 <h2>Klasių valdymas</h2>
  							<p>Sukurti naują klasę:</p>   
							<input type="text" name=klasesPavadinimas placeholder="įveskite klasės pavadinimą.."><br/>
							<br />
							<button type="submit" class="btn btn-info" name="save2">Pridėti naują</button>
						</form>


					<h2>Pasirinkite klasę</h2>
					<label for="recipient-name" class="form-control-label">Klasė</label>
					   <?php
						if(isset($_POST['klase'])){
    					$selectOption = $_POST['klase'];
						}
						?> 
						<form action="" method="post">
						<?php
							$query6 = "SELECT * from klase";
							echo'<select class= "custom-select" name="klase">';
							echo'<option value="0">Pasirinkite...</option>';
							$klas = $database->query($query6);
							while ( $row=mysqli_fetch_assoc($klas)) {?>
								 <option value=<?php echo $row['klase'];
								 if(isset($_POST['klase']) && $_POST['klase'] == $row['klase'])
								 echo 'selected="selected"'; ?>
								><?php echo $row['klase'] ?></option>;
							<?php }
							echo '</div>';
							echo'<input type="submit" class="btn btn-primary" value="Ieškoti.."/>';
						?>	
							</select>
						
									
						</fieldset>

						<legend></legend>
						<div class="row">
        				<div class="col-md-12">
           				<div class="panel-body">
 						 <h2>Mokinių sąrašas</h2>
  							<p>Pasirinktos klasės mokinių sąrašas:</p>         
							 <div class="row">
        						<div class="col-md-12">
           						<div class="panel-body">
           						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-1">Pridėti mokinį</button>
           						<div class=scroll style='overflow: auto;height: 250px; width: 950px;'>
               					<table class="table table-fixed table-hover table-striped table-bordered">
               					<thead>
				  				  <p></p> 
				  				 <div></div>
									<div class="modal fade" id="modal-1">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												 <div class="modal-header">
												 	<button type="button" class="close" data-dismiss="modal">&times;</button>
												 	<h3 class="modal-title">Įtraukti mokinį į sąrašą</h3>
												 </div>
									 				<?php
													  if(isset($_POST['save']))
													{
														//sukuriamas vartotojas
													    $sql    = "INSERT INTO vartotojas (prisijungimoVardas, slaptazodis, vardas, pavarde, lygis)
													    VALUES ('".$_POST["vartotojoVardas"]."','".$_POST["slaptazodis"]."','".$_POST["vardas"]."','".$_POST["pavarde"]."', '1')";
													    $result = $database->query($sql);

													   	//paimamas ką tik sukurto vartotojo ID
													    $SQL    = "SELECT MAX(id_Vartotojas) as id_Vartotojas FROM vartotojas";
													    $id     = $database->query($SQL);
													    $row2   = mysqli_fetch_assoc($id);

													    //išrenkamas klasės ID
													    $selectOption2 = $_POST['klase2'];
													    $strSQL ="SELECT id_Klase FROM klase WHERE klase='$selectOption2'";
													    $klase2 = $database->query($strSQL);
													    $row    =mysqli_fetch_assoc($klase2);

													    //išrenkamas tėvo ID
													    $tevas = $_POST['tevass'];
													    $strSQL1 ="SELECT id_Vartotojas FROM vartotojas WHERE vardas='$tevas'";
													    $klase3 = $database->query($strSQL1);
													    $row4    =mysqli_fetch_assoc($klase3);

													    //sukuriamas mokinys
													    $sql    = "INSERT INTO mokinys (id_Vartotojas, fk_Klase, fk_MokinioTevas)
													    VALUES ('".$row2['id_Vartotojas']."','".$row['id_Klase']."', '".$row4['id_Vartotojas']."')";
													    $result = $database->query($sql);

													}?>
												 <form action="" method="post">
												 <div class="modal-body">
										          <div class="form-group">
										            <label for="recipient-name" class="form-control-label">Vardas:</label>
										            <input type="text" name="vardas" class="form-control" id="recipient-name">
										          </div>
										          <div class="form-group">
										            <label for="recipient-name" class="form-control-label">Pavardė:</label>
										            <input type="text" name="pavarde" class="form-control" id="recipient-name">
										          </div>
										          <div class="form-group">
										            <label for="recipient-name" class="form-control-label">Klasė: </label>
										            <input type="text" name="klase2" class="form-control" id="recipient-name" value=<?php echo $selectOption?> readonly="readonly">
												  </div>
										         <div class="form-group">
										            <label for="recipient-name" class="form-control-label">Vartotojo vardas:</label>
										            <input type="text" name="vartotojoVardas" class="form-control" id="recipient-name">
										          </div>
										        <div class="form-group">
										            <label for="recipient-name" class="form-control-label">Slaptažodis: </label>
										            <input type="password" name="slaptazodis" class="form-control" id="inputPassword2" placeholder="Password">
										          </div>
												    <div class="form-group">
												      <label for="inputState">Mokinio tėvas</label>
												      <select id="inputState" class="form-control" name = tevass>
												      <?php
												      $query_tevas = "SELECT * from vartotojas WHERE lygis = '3'";
												      $tev = $database->query($query_tevas);
															while ( $row5=mysqli_fetch_assoc($tev)) {?>
																	 <option value=<?php echo $row5['vardas'];
																 if(isset($_POST['vardas']) && $_POST['vardas'] == $row5['vardas'])
								 									echo 'selected="selected"';
																 ?>><?php echo $row5['vardas'], ' ', $row5['pavarde'] ?></option>;
															<?php }
												       ?>
												        <option selected>Pasirinkite...</option>										        
											       <div class="form-group">
										        <label for="recipient-name" class="form-control-label">Mokinio tėvas: </label>	
												</select>								       
										      </div>
										      	 <div class="modal-footer">
												 	<a href="" class="btn btn-default" data-dismiss="modal">Uždaryti</a>
			   								 	    <button type="submit" class="btn btn-primary" name="save">Išsaugoti</button>
			   								 	    </select>
										          </div>
												 </div>
												  </form>
							</div>
							</div> 
							</div>
							</div>
							</div> 
								
								      <tr>
								        <th>Vardas</th>
								        <th>Pavardė</th>
								        <th>Klasė</th>
								      </tr>
								    </thead>
								    <tbody>
								    <?php
								    $queryMokiniai = "SELECT * FROM klase, mokinys, vartotojas where klase.klase = '$selectOption' and klase.id_klase=mokinys.fk_Klase and mokinys.id_Vartotojas = vartotojas.id_Vartotojas";
               						$mokiniai = $database->query($queryMokiniai);
               						while ( $row=mysqli_fetch_assoc($mokiniai)) { ?>
										<tr>
								        <td><?php echo "<option value='".$row['vardas']."'>".$row['vardas']."</option>"; ?></td>
								        <td><?php echo "<option value='".$row['pavarde']."'>".$row['pavarde']."</option>"; ?></td>
								        <td><?php echo "<option value='".$row['klase']."'>".$row['klase']."</option>" ?></td>

								        </tr>
									<?php } ?>
								    </tbody>
								  </table>

							</form>


    <?php  
		$connect = mysqli_connect("localhost", "root", "", "dienynas2");
		if(isset($_POST["submit8"]))
		{
		 if($_FILES['file']['name'])
		 {
		  $filename = explode(".", $_FILES['file']['name']);
		  if($filename[1] == 'csv')
		  {
		   $handle = fopen($_FILES['file']['tmp_name'], "r");
		   while($data = fgetcsv($handle))
		   {
		    $item1 = mysqli_real_escape_string($connect, $data[0]);  
		                $item2 = mysqli_real_escape_string($connect, $data[1]);
		                $item3 = mysqli_real_escape_string($connect, $data[2]);
		                $item4 = mysqli_real_escape_string($connect, $data[3]);
		                $item5 = mysqli_real_escape_string($connect, $data[4]);
		                $item6 = mysqli_real_escape_string($connect, $data[5]);
		                $item7 = mysqli_real_escape_string($connect, $data[6]);
		                $item8 = mysqli_real_escape_string($connect, $data[7]);
		                $query = "INSERT into vartotojas (prisijungimoVardas, slaptazodis,vardas,pavarde,busena,lygis) values('$item1','$item2','$item3','$item4','$item5', '$item6')";
		                $id    = $database->query($query);
		                
		                //paimamas ką tik sukurto vartotojo ID
						$SQL    = "SELECT MAX(id_Vartotojas) as id_Vartotojas FROM vartotojas";
						$id     = $database->query($SQL);
						$row2   = mysqli_fetch_assoc($id);

		             	//išrenkamas klasės ID
						$selectOptionCSV = $_POST['klase2'];
						$sqlCSV ="SELECT id_Klase FROM klase WHERE klase='$selectOption'";
						$klaseCSV = $database->query($sqlCSV);
						$rowCSV    =mysqli_fetch_assoc($klaseCSV);

						//išrenkamas tėvo ID
						/*$tevas = $_POST['tevass'];
						$strSQL1 ="SELECT id_Vartotojas FROM vartotojas WHERE vardas='$tevas'";
						$klase3 = $database->query($strSQL1);
						$row4    =mysqli_fetch_assoc($klase3);*/

						//sukuriamas mokinys
						$sql    = "INSERT INTO mokinys (id_Vartotojas, fk_Klase, fk_MokinioTevas)
						VALUES ('".$row2['id_Vartotojas']."','$item8', '$item7')";
						$result = $database->query($sql);
		   }
		   fclose($handle);
		   echo "<script>alert('Importavimas baigtas');</script>";
		  }
		 }
		}
		?>
                        <tr><td> 
                        <div class="row">
        				<div class="col-md-12">
           				<div class="panel-body">
                        <h3>Importuoti mokinių sąrašą</h3>
						<form method="post" enctype="multipart/form-data">					   
						    <label>Pasirinkite CSV failą:</label>
						    <input type="file" name="file" />
						    <br />
						    <input type="submit" name="submit8" value="Importuoti" class="btn btn-info" />			   
						  </form>
						  </div>
						  </div>
						  </div>
   
    </td></tr>
    </form>
    <?php
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