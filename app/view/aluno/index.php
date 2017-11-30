<?php include_once ("header.php"); ?>

    <?php 
        
        foreach ($_REQUEST as $___opt => $___val) {
            $$___opt = $___val;
        }
        if (empty($pg)) {
            include("home.php");
        }
        elseif (substr($pg, 0, 4) == 'http' or substr($pg, 0, 1) == "/" or substr($pg, 0, 1) == ".") {
            echo "<br><font face=arial size=11px><br><b>A pagina não existe.</b><br>Por favor selecione uma página a partir do menu principal.";
        }
        else {
            include("$pg.php");
        }
        
    ?>
            
<?php include_once ("footer.php"); ?>


