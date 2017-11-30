<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('classes/dao/ArquivoDAO.php');

$arquivo = new Arquivo();
$arqDAO = new ArquivoDAO();

if(isset($_GET['id'])){
	$arquivo = $arqDAO -> Pesquisar($_GET['id']);
	$caminho_arq = substr($arquivo->getCaminho_arq(), 7);
	
	if(file_exists($caminho_arq)){
		//header("Content-Description: File Transfer");
		//header("Content-Disposition: attachment; filename=".$arquivo->getNome_arq().".pdf");
		//header("Content-Type: application/pdf");
		// Envia o arquivo para o cliente
		//readfile($arquivo->getCaminho_arq().$arquivo->getNome_arq().'.pdf');
		header("Location: ".$caminho_arq);
	}
}else{
    header("Location: ../repositorio/");
    exit;
}
?>