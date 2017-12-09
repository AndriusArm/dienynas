<?php
include("../include/session.php");

$selectOption = '0';
if (!$session->isAdministratorius()) {
    header("Location: ../index.php");
} else { //Jei moderatorius
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
                        <div class="row">
        				<div class="col-md-12">
           				<div class="panel-body">
                        <h3>Importuoti mokinių sąrašą</h3>
                        <form>
						  <div class="form-group">
						    <label for="exampleFormControlFile1">Pasirinkite .csv failą</label>
						    <input type="file" class="form-control-file" id="exampleFormControlFile1">
						  </div>
						</form>
                        <form action="" method="post">
						<fieldset><legend></legend>

							<?php
							  if(isset($_POST['save2']))
							{
							    $sql = "INSERT INTO klase (klase)
							    VALUES ('".$_POST["klasesPavadinimas"]."')";
							    $result = $database->query($sql);
							}
							?>
							<form action="" method="post"> 
							<label id="first"> Klasė:</label><br/>
							<input type="text" name=klasesPavadinimas><br/>
							<button type="submit" class="btn btn-primary" name="save2">Pridėti naują</button>
							</form>


							<h2>Pasirinkite klasę</h2>

					<label for="recipient-name" class="form-control-label">Klasė</label>
					   <?php
						$query6 = "SELECT * from klase";	
						if(isset($_POST['klase'])){
    					$selectOption = $_POST['klase'];
    					switch ($selectOption) {
       						 case 'value1':
          					  echo 'this is value1<br/>';
          					  break;
							        case 'value2':
							            echo 'value2<br/>';
							            break;
							        default:
							            # code...
							            break;
							    }
							}
							echo'<select clas= "custom-select" name="klase">';
							echo'<option value="0">Pasirinkite...</option>';
							$klas = $database->query($query6);
							while ( $row=mysqli_fetch_assoc($klas)) {
								echo "<option value='".$row['klase']."'>".$row['klase']."</option>";
							}
							echo '</div>';
							echo'<input type="submit" class="btn btn-primary" value="Ieškoti.."/>';
							?>	
							</select>
							</form>
							<br><br>

											
						</fieldset>
						<legend></legend>
 						 <h2>Mokinių sąrašas</h2>
  							<p>Pasirinktos klasės mokinių sąrašas:</p>         
							 <div class="row">
        						<div class="col-md-12">
           						<div class="panel-body">
               					<table class="table table-fixed table-hover table-striped table-bordered">
               					<thead>
				  				  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1">Pridėti mokinį</button>
				  				  <p></p> 
				  				 
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
													    $sql = "INSERT INTO vartotojas (prisijungimoVardas, slaptazodis, vardas,pavarde)
													    VALUES ('".$_POST["username3"]."','".$_POST["password"]."','".$_POST["username"]."','".$_POST["username2"]."')";
													    $result = $database->query($sql);
													}
													?>
												 <form action="" method="post">
												 <div class="modal-body">
										          <div class="form-group">
										            <label for="recipient-name" class="form-control-label">Vardas:</label>
										            <input type="text" name="username" class="form-control" id="recipient-name">
										          </div>
										          <div class="form-group">
										            <label for="recipient-name" class="form-control-label">Pavardė:</label>
										            <input type="text" name="username2" class="form-control" id="recipient-name">
										          </div>
										          <div class="form-group">
										            <label for="recipient-name" class="form-control-label">El.paštas:</label>
										            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
										            <div class="input-group-addon">@</div>
										            <input type="text" class="form-control" id="recipient-name" placeholder="vardas@gmail.com">
										            </div>
										          </div>
										          <div class="form-group">
										            <label for="recipient-name" class="form-control-label">Klasė: </label>
													      <p class="form-control-static"><?php echo $selectOption?></p>
												  </div>
										         <div class="form-group">
										            <label for="recipient-name" class="form-control-label">Vartotojo vardas:</label>
										            <input type="text" name="username2" class="form-control" id="recipient-name">
										          </div>
										        <div class="form-group">
										            <label for="recipient-name" class="form-control-label">Slaptažodis: </label>
										            <input type="password" name="password" class="form-control" id="inputPassword2" placeholder="Password">
										          </div>
										       
										      </div>
										      	 <div class="modal-footer">
												 	<a href="" class="btn btn-default" data-dismiss="modal">Uždaryti</a>
			   								 	    <a href="" type="submit" name="save" class="btn btn-primary">Išsaugoti</a>
												 </div>
												  </form>
										    </div>
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
								</div>
								</div>
								</div>
							</form>
               <tr><td><hr></td></tr>
            </td></tr>
    </td></tr>
   
    </td></tr>
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