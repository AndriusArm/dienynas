<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php
include("include/session.php");
if ($session->logged_in) {
    ?>
    <html>
        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
              <legend></legend>
            <title>Paskyra</title>
            <link href="include/styles2.css" rel="stylesheet" type="text/css" />
        </head>
        <body>       
            <table class="center"><tr><td>
                        <center><img src="pictures/top.jpg"/></center>
                    </td></tr><tr><td> 
                        <?php
                        /**
                         * User has submitted form without errors and user's
                         * account has been edited successfully.
                         */
                        include("include/meniu.php");
                        ?>
						<div style="text-align: center;color:white">
                        <legend></legend>
						<h1>Paskyros redagavimas</h1>
						</div><br>
                        <?php
                        if (isset($_SESSION['useredit'])) {
                            unset($_SESSION['useredit']);
                            echo "<p><b>$session->username</b>, Jūsų paskyra buvo sėkmingai atnaujinta.<br><br>";
                        } else {
                            echo "<div align=\"center\">";
                            if ($form->num_errors > 0) {
                                echo "<font size=\"3\" color=\"#ff0000\">Klaidų: " . $form->num_errors . "</font>";
                            } else {
                                echo "";
                            }
                            ?>
                            <table bgcolor=#C3FDB8 >
                                <tr><td>
                                        <form action="process.php" style="text-align:left;" method="POST">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="form-control-label">Dabartinis slaptažodis:</label>
                                                    <input type="password" class="form-control" name="curpass" maxlength="30" size="25" value="<?php echo $form->value("curpass"); ?>">
                                                <br><?php echo $form->error("curpass"); ?></p>
                                                </div>
                                                 <div class="form-group">
                                                    <label for="recipient-name" class="form-control-label">Naujas slaptažodis:</label>
                                                    <input type="password" class="form-control" name="newpass" maxlength="30" size="25" value="<?php echo $form->value("newpass"); ?>">
                                                <br><?php echo $form->error("newpass"); ?></p>
                                                  </div>
                                            <input type="hidden" name="subedit" value="1">
                                            <input type="submit" class="btn btn-success" value="Atnaujinti">
                                        </form>
                                    </td></tr>
                            </table>

                            <?php
                            echo "</div>";
                        }
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