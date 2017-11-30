<?php
	
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
/*require_once('controller/CryptSenha.php');
//require_once('model/Conexao.class.php');
//require_once('model/Usuario.class.php');
require_once('model/dao/UsuarioDAO.php');
include 'conf/Config.inc';*/
function __autoload($classe){
	$cont = 0;
	$diretorios = array(
			'/',
			'../',
			'controller/',
			'../controller/',
			'model/',
			'../model/',
			'model/dao/',
			'../model/dao/',
			'view/',
			'../view/'
	);
	foreach ($diretorios AS $dir){
		if(file_exists($dir . $classe . '.class.php')){
			require_once $dir.$classe.'.class.php';
			$cont++;
		}else{
			if(file_exists($dir . $classe . '.php')){
				require_once $dir . $classe . '.php';
				$cont++;
			}
		}
	}
	if($cont == 0){
		echo 'Erro ao importar a classe "'. $classe . '"!';
	}
}

$crypt = new CryptSenha();
$conn = new Conexao();
$pdo = $conn->Connect();

$idUsuario = 0;
$login = '';
$senha = '';
$permissao = '';
$status = '';
try{
	$sql = 'SELECT * FROM Usuario WHERE login = :login;';
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':login', $_POST['usuario']);
	$stmt->execute();
			
	if($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
		$idUsuario = $linha['idUsuario'];
		$login = $linha['login'];
		$senha = $linha['senha'];
		$permissao = $linha['permissao'];
		$status = $linha['status'];
	}
}catch(PDOException $e){
	echo 'ERRO: '.$e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>404 Not Found</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript">
	function loginsuccessfullyModerador(){
    	setTimeout("window.location.href='view/moderador'", 10);
    }
	
	function loginsuccessfullyAdmin(){
    	setTimeout("window.location.href='view/admin/'", 10);
    }
            
    function loginfailed(){
    	alert("Usuário ou Senha incorretos.");
    	setTimeout("window.location.href='index.php'", 10);
    }
</script>
</head>
<body>
	
	<?php
	if(isset($_POST['usuario'])){
		if($login != ''){
			$check = $crypt->check($_POST['senha'], $senha);
			if($check == 1){
				if ($permissao === '0') {
					session_start();
					$_SESSION['admin'] = $login;
					echo "<script>loginsuccessfullyAdmin()</script>";
				} else {
					if($permissao === '1'){
						session_start();
						$_SESSION['usuario'] = $login;
						echo "<script>loginsuccessfullyModerador()</script>";	
					}
				}
			}else{
				echo "<script>loginfailed()</script>";
			}
		}else{
			echo "<script>loginfailed()</script>";
		}	
	}else{
		header("Location: ../");
	}
?>
</body>
</html>
<?php
    ob_end_flush();
?>