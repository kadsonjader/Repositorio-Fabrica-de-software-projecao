<?php
require_once '../../model/Conexao.class.php';

$con = new Conexao();
$pdo = $con->Connect();

$sql = "SELECT * FROM Usuario AS u 
	INNER JOIN Pessoa AS p ON u.Pessoa_idPessoa = p.idPessoa
	WHERE u.permissao = '1'
	ORDER BY p.nome_completo;";
$stmt = $pdo->prepare($sql);
$stmt->execute();

//echo '<br/>';
//echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
$nomes = array();
$i = 0;
while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
	//$nome[$i] = "nome".array($linha['nome']);
	$nomes[$i] = ['id' => ''.$linha['idUsuario'], 'nome' => $linha['nome_completo'], 'matricula' => $linha['matricula']];
	$i++;
}
//echo '<br/>';
echo json_encode($nomes);
?>