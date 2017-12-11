<?php
include("../include/session.php");

if (!$session->isAdministratorius()) {
    header("Location: ../index.php");
} else { //Jei administratorius
?>

<?php 
$id = $_GET['id'];
$queryMokiniai = "SELECT * FROM vartotojas where id_Vartotojas = '$id'";
$mokiniai = $database->query($queryMokiniai);
$row=mysqli_fetch_assoc($mokiniai);
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="myModalLabel">Mokinio informacijos peržiūra</h4>
</div>
<div class="modal-body">
  <div class="panel panel-info" ">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
        
									 				<?php
													  if(isset($_POST['update']))
													{
														//sukuriamas vartotojas
													    /*$prisijungimoVardas = $_POST["vartotojoVardas"];
													    $sql    = "UPDATE vartotojas 
													    SET prisijungimoVardas = $prisijungimoVardas WHERE id_Vartotojas = $id";
													    $result = $database->query($sql);*/

													   	//paimamas ką tik sukurto vartotojo ID 
													   /* $SQL    = "SELECT MAX(id_Vartotojas) as id_Vartotojas FROM vartotojas";
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
													    $result = $database->query($sql);*/

													}?>
												 <form action="" method="post">
												 <div class="modal-body">
										          <div class="form-group">
										            <label for="recipient-name" class="form-control-label">Vardas:</label>
										            <input type="text" name="vardas" class="form-control" id="recipient-name" value = <?php echo $row['vardas']?> readonly="readonly" >
										          </div>
										          <div class="form-group">
										            <label for="recipient-name" class="form-control-label">Pavardė:</label>
										            <input type="text" name="pavarde" class="form-control" id="recipient-name" value = <?php echo $row['pavarde']?> readonly="readonly">
										          </div>
										         <div class="form-group">
										            <label for="recipient-name" class="form-control-label">Vartotojo vardas:</label>
										            <input type="text" name="vartotojoVardas" class="form-control" id="recipient-name" value = <?php echo $row['prisijungimoVardas']?> readonly="readonly">
										          </div>
										          	
												    <?php

												    $queryTevas = "SELECT vardas,pavarde FROM mokinys, vartotojas where mokinys.id_Vartotojas = '$id' and mokinys.fk_MokinioTevas = vartotojas.id_Vartotojas";
				               						$mokiniai = $database->query($queryTevas);
				               						$x=" ";
				               						while ( $row=mysqli_fetch_assoc($mokiniai)) { ?>
				               						
				               						<div class="form-group">
										            <label for="recipient-name" class="form-control-label">Mokinio tėvas:</label>
										           
										            <p><?php echo $row['vardas'] ?> <?php echo $row['pavarde'] ?></p>
										         
												    <?php } ?>
												    </div>
												    </div>
												    </div>


										      	 <div class="modal-footer">
												 	<a href="" class="btn btn-default" data-dismiss="modal">Uždaryti</a>
			   								 	    <button type="submit" class="btn btn-primary" name="update">Išsaugoti</button>
			   								 	    </select>
										          </div>
												 </div>
												  </form>							       
	
														</div> 
							</div>
							</div>
            </p>
          </div>
        </div>
        <!-- /.col-lg-6 (nested) -->
    </div>
  </div>
</div>
</div>

    <?php
}
?>