<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../../model/Arquivo.class.php');
require_once('../../model/dao/ArquivoDAO.php');

$arquivo = new Arquivo();
$arqDAO = new ArquivoDAO();

if(isset($_GET['id'])){
	$arquivo = $arqDAO -> Pesquisar($_GET['id']);
	
	if(file_exists($arquivo->getCaminho_arq().$arquivo->getNome_arq().'.pdf')){
		//header("Content-Description: File Transfer");
		//header("Content-Disposition: attachment; filename=".$arquivo->getNome_arq().".pdf");
		//header("Content-Type: application/pdf");
		// Envia o arquivo para o cliente
		//readfile($arquivo->getCaminho_arq().$arquivo->getNome_arq().'.pdf');
		header("Location: ".$arquivo->getCaminho_arq().$arquivo->getNome_arq().".pdf");
	}
}
?>