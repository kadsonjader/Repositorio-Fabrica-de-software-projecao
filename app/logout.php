<?php
    ob_start();
    session_start();
    session_destroy();
    if(isset($_SESSION['usuario'])){
    	unset($_SESSION['usuario']);
    }else{
    	unset($_SESSION['aluno']);
    }
    header("Location: ../app/");
    exit;
    ob_end_flush();
?>