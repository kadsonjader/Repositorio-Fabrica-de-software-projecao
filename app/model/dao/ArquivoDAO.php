<?php
require_once '../../model/Arquivo.class.php';
require_once '../../model/Conexao.class.php';
class ArquivoDAO {
    public function __construct() {
        $this -> con = new Conexao() ;
        $this -> pdo = $this -> con -> Connect();
    }
    
    public function Inserir(Arquivo $arquivo){
        try{
            $sql = 'INSERT INTO Arquivo VALUES (DEFAULT, :titulo, :aluno, :orientador, :hora, :palavra_chave, :caminho_arq, :idSemestre, :idUsuario);';
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindValue(":titulo", $arquivo->getTitulo());
			$stmt -> bindValue(":aluno", $arquivo->getAluno());
			$stmt -> bindValue(":orientador", $arquivo->getOrientador());
            $stmt -> bindValue(":hora", $arquivo->getHora());
            $stmt -> bindValue(":palavra_chave", $arquivo->getPalavra_chave());
            $stmt -> bindValue(":caminho_arq", $arquivo->getCaminho_arq());
            $stmt -> bindValue(":idSemestre", $arquivo->getSemestre_idSemestre());
            $stmt -> bindValue(":idUsuario", $arquivo->getUsuario_idUsuario());
            
            return $stmt -> execute();
        } catch (Exception $ex) {
            echo 'ERRO: ' . $ex ->getMessage();
        }
    }
	
	public function Alterar(Arquivo $arquivo){
        try{
            $sql = 'UPDATE Arquivo SET titulo = :titulo, aluno = :aluno, orientador = :orientador, 
			hora = :hora, palavra_chave = :palavra_chave,
			caminho_arq = :caminho_arq, Semestre_idSemestre = :idSemestre, Usuario_idUsuario = :idUsuario
			WHERE idArquivo = :idArquivo;';
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindValue(":titulo", $arquivo->getTitulo());
			$stmt -> bindValue(":aluno", $arquivo->getAluno());
			$stmt -> bindValue(":orientador", $arquivo->getOrientador());
            $stmt -> bindValue(":hora", $arquivo->getHora());
            $stmt -> bindValue(":palavra_chave", $arquivo->getPalavra_chave());
            $stmt -> bindValue(":caminho_arq", $arquivo->getCaminho_arq());
            $stmt -> bindValue(":idSemestre", $arquivo->getSemestre_idSemestre());
            $stmt -> bindValue(":idUsuario", $arquivo->getUsuario_idUsuario());
			$stmt -> bindValue(":idArquivo", $arquivo->getIDArquivo());
            
            return $stmt -> execute();
        } catch (Exception $ex) {
            echo 'ERRO: ' . $ex ->getMessage();
        }
    }
	
	public function Deletar(int $idArquivo){
        try{
            $sql = 'DELETE FROM Arquivo WHERE idArquivo = :id;';
            $stmt = $this -> pdo -> prepare($sql);
			$stmt -> bindValue(":id", $idArquivo);
            
            return $stmt -> execute();
        } catch (Exception $ex) {
            echo 'ERRO: ' . $ex ->getMessage();
        }
		return false;
    }
	
	public function Pesquisar(int $idArquivo) {
		
        $arquivo = new Arquivo();
		try{
			$sql = "SELECT * FROM Arquivo WHERE idArquivo = :idArquivo;";
			$stmt = $this -> pdo -> prepare($sql);
			$stmt -> bindValue(':idArquivo', $idArquivo);
			$stmt -> execute();
			
			if($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
				$arquivo -> setIDArquivo($linha['idArquivo']);
				$arquivo -> setTitulo($linha['titulo']);
				$arquivo -> setAluno($linha['aluno']);
				$arquivo -> setOrientador($linha['orientador']);
				$arquivo -> setHora($linha['hora']);
				$arquivo -> setPalavra_chave($linha['palavra_chave']);
				$arquivo -> setCaminho_arq($linha['caminho_arq']);
				$arquivo -> setSemestre_idSemestre($linha['Semestre_idSemestre']);
				$arquivo -> setUsuario_idUsuario($linha['Usuario_idUsuario']);
				
				return $arquivo;
			}
		}catch(PDOException $e){
			echo 'ERRO: '.$e -> getMessage();
		}
		return null;
    }
	
	public function Listar(){
        $arquivo = array();
		try{
            $sql = "SELECT * FROM Arquivo;";
            $stmt = $this->pdo->prepare($sql);
			$stmt->execute();
            
			$i = 0;
			while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
				$arquivo[$i] = new Arquivo();
				$arquivo[$i] -> setIDArquivo($linha['idArquivo']);
				$arquivo[$i] -> setTitulo($linha['titulo']);
				$arquivo[$i] -> setAluno($linha['aluno']);
				$arquivo[$i] -> setOrientador($linha['orientador']);
				$arquivo[$i] -> setHora($linha['hora']);
				$arquivo[$i] -> setPalavra_chave($linha['palavra_chave']);
				$arquivo[$i] -> setCaminho_arq($linha['caminho_arq']);
				$arquivo[$i] -> setSemestre_idSemestre($linha['Semestre_idSemestre']);
				$arquivo[$i] -> setUsuario_idUsuario($linha['Usuario_idUsuario']);
				
				$i++;
			}
            return $arquivo;
        } catch (Exception $ex) {
            echo 'ERRO: ' . $ex ->getMessage();
        }
    }
	
	public function TotalRegistro(){
		try{
			$sql = "SELECT COUNT(*) AS total FROM Arquivo;";
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
