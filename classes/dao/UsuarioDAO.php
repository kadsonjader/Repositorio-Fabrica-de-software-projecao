<?php

require_once 'classes/Conexao.class.php';
require_once 'classes/Usuario.class.php';

class UsuarioDAO {

    public function __construct() {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }

    public function Inserir(Usuario $usuario) {
		
        try {
            $sql = 'INSERT INTO Usuario VALUES (DEFAULT, :login, :senha, :permissao, :status);';
            $stmt = $this->pdo->prepare($sql);
            $stmt -> bindValue(":login", $usuario->getLogin());
            $stmt -> bindValue(":senha", $usuario->getSenha());
            $stmt -> bindValue(":permissao", $usuario->getPermissao());
			$stmt -> bindValue(":status", $usuario->getStatus());

            return $stmt -> execute();
        } catch (Exception $ex) {
			echo 'ERRO: ' . $ex -> getMessage();
        }
    }
	
	public function Alterar(Usuario $usuario){
		
		try{
			
			if($usuario -> getSenha() != ''){
				$sql = 'UPDATE Usuario SET login = :login, senha = :senha, permissao = :permissao, status = :status 
				WHERE idUsuario = :idUsuario;';
				$stmt = $this -> pdo -> prepare($sql);
				$stmt -> bindValue(":login", $usuario->getLogin());
				$stmt -> bindValue(":senha", $usuario->getSenha());
				$stmt -> bindValue(":permissao", $usuario->getPermissao());
				$stmt -> bindValue(":status", $usuario->getStatus());
				$stmt -> bindValue(":idUsuario", $usuario->getIDUsuario());
				$stmt -> execute();
			}else{
				$sql = 'UPDATE Usuario SET login = :login, permissao = :permissao, status = :status 
				WHERE idUsuario = :idUsuario;';
				$stmt = $this -> pdo -> prepare($sql);
				$stmt -> bindValue(":login", $usuario->getLogin());
				$stmt -> bindValue(":permissao", $usuario->getPermissao());
				$stmt -> bindValue(":status", $usuario->getStatus());
				$stmt -> bindValue(":idUsuario", $usuario->getIDUsuario());
				$stmt -> execute();
			}
			
			return true;
			
		}catch(Exception $ex){
			echo 'ERRO: ' . $ex->getMessage();
		}
		return false;
	}
	
	public function Deletar(int $idUsuario) {
		try{
			$sql = 'DELETE FROM Usuario WHERE idUsuario = :id';
			$stmt = $this -> pdo -> prepare($sql);
			$stmt -> bindValue(':id', $idUsuario);
			return $stmt->execute();
		}catch(PDOException $ex){
			echo 'ERRO: ' . $ex->getMessage();
		}
		return false;
    }
	
	public function Pesquisar(int $idUsuario) {
		
        $usuario = new Usuario();
		try{
			$sql = "SELECT * FROM Usuario
				WHERE idUsuario = :idUsuario AND status = 'A';";
			$stmt = $this -> pdo -> prepare($sql);
			$stmt -> bindValue(':idUsuario', $idUsuario);
			$stmt -> execute();
			
			if($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
				$usuario -> setIDUsuario($linha['idUsuario']);
				$usuario -> setLogin($linha['login']);
				$usuario -> setSenha($linha['senha']);
				$usuario -> setPermissao($linha['permissao']);
				$usuario -> setStatus($linha['status']);
				
				return $usuario;
			}
		}catch(PDOException $e){
			echo 'ERRO: '.$e -> getMessage();
		}
		return null;
    }
	
	public function Listar(){
		
		$usuario = array();
		try{
			$sql = "SELECT * FROM Usuario;";
			$stmt = $this -> pdo -> prepare($sql);
			$stmt -> execute();
			$i = 0;
			while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
				$usuario[$i] = new Usuario();
				$usuario[$i] -> setIDUsuario($linha['idUsuario']);
				$usuario[$i] -> setLogin($linha['login']);
				$usuario[$i] -> setSenha($linha['senha']);
				$usuario[$i] -> setPermissao($linha['permissao']);
				$usuario[$i] -> setStatus($linha['status']);
				
				$i++;
			}
			
			return $usuario;
			
		}catch(Exception $ex){
			echo 'ERRO: '.$e -> getMessage();
		}
		return null;
	}
	
	public function buscarPorLogin($login) {
		
		$usuario = new Usuario();
		try {
			$sql = "SELECT * FROM Usuario WHERE login = :login;";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':login', $login);
			$stmt->execute();
			
			if($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
				$usuario -> setIDUsuario($linha['idUsuario']);
				$usuario -> setLogin($linha['login']);
				$usuario -> setSenha($linha['senha']);
				$usuario -> setPermissao($linha['permissao']);
				$usuario -> setStatus($linha['status']);
				
				return $usuario;
			}
		}catch(PDOException $e){
			echo 'ERRO: '.$e->getMessage();
		}
		return null;
	}
	
	public function TotalRegistro(){
		try{
			$sql = "SELECT COUNT(*) AS total FROM Usuario WHERE status = 'A';";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			
			if($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
				return $linha['total'];
			}
		}catch(PDOException $e){
			echo 'ERRO: '.$e->getMessage();
		}
		return 0;
	}

}
