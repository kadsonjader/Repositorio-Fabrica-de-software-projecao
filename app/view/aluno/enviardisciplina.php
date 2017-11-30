<?php 
require_once '../../model/Conexao.class.php';

$con = new Conexao();
$pdo = $con->Connect();
if(isset($_GET['acao'])){
$sql = "SELECT * FROM Disciplina 
	WHERE Curso_idCurso = :idCurso
	ORDER BY disciplina;";
$stmt = $pdo->prepare($sql);
$stmt -> bindValue(":idCurso", $_GET['acao']);
$stmt->execute();

//echo '<br/>';
//echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
$nomes = array();
$i = 0;
/*while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo "<option value='".$linha['idDisciplina']."'>".$linha['disciplina']."</option>";
}*/
while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
	//$nome[$i] = "nome".array($linha['nome']);
	$nomes[$i] = ['idDisciplina' => ''.$linha['idDisciplina'], 'disciplina' => $linha['disciplina'], 'idCurso' => $linha['Curso_idCurso']];
	$i++;
}
//echo '<br/>';
echo json_encode($nomes);
}
?>