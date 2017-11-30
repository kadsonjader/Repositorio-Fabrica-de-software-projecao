<?php
require_once '../../model/Conexao.class.php';
require_once '../../model/Semestre.class.php';
class SemestreDAO {
    
    public function __construct() {
        $this -> con = new Conexao() ;
        $this -> pdo = $this -> con -> Connect();
    }
    
    public function Inserir(Semestre $semestre){
        try{
            $sql = 'INSERT INTO Semestre VALUES (DEFAULT, :semestre, :ano, :idDisciplina);';
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindValue(":semestre", $semestre->getSemestre());
            $stmt -> bindValue(":ano", $semestre->getAno());
			$stmt -> bindValue(":idDisciplina", $semestre->getDisciplina_idDisciplina());
            
            return $stmt -> execute();
        } catch (Exception $ex) {
            echo 'ERRO: ' . $ex -> getMessage();
        }
		return false;
    }
	
	public function Alterar(Semestre $semestre){
		
		try{
			$sql = 'UPDATE Semestre SET semestre = :semestre, ano = :ano, Disciplina_idDisciplina = :idDisciplina
			WHERE idSemestre = :idSemestre';
			$stmt = $this -> pdo -> prepare($sql);
			$stmt -> bindValue(":semestre", $semestre->getSemestre());
			$stmt -> bindValue(":ano", $semestre->getAno());
			$stmt -> bindValue(":idDisciplina", $semestre->getDisciplina_idDisciplina());
			$stmt -> bindValue(":idSemestre", $semestre->getIDSemestre());
			
			return $stmt -> execute();
		}catch(Exception $ex){
			echo 'ERRO: ' . $ex -> getMessage();
		}
		return false;
	}
	
	public function Deletar(int $idSemestre){
		
		try{
			$sql = "DELETE FROM Semestre WHERE idSemestre = :idSemestre;";
			$stmt = $this -> pdo -> prepare($sql);
			$stmt -> bindValue(":idSemestre", $idSemestre);
			
			return $stmt -> execute();
		}catch(Exception $ex){
			echo 'ERRO: ' . $ex -> getMessage();
		}
		return false;
	}
	
	public function Pesquisar(int $idSemestre){
		
		$semestre = new Semestre();
		try{
			$sql = "SELECT * FROM Semestre WHERE idSemestre = :idSemestre;";
			$stmt = $this -> pdo -> prepare($sql);
			$stmt -> bindValue(':idSemestre', $idSemestre);
			$stmt -> execute();
			
			if($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
				$semestre -> setIDSemestre($linha['idSemestre']);
				$semestre -> setSemestre($linha['semestre']);
				$semestre -> setAno($linha['ano']);
				$semestre -> setDisciplina_idDisciplina($linha['Disciplina_idDisciplina']);
				
				return $semestre;
			}
		}catch(PDOException $e){
			echo 'ERRO: '.$e -> getMessage();
		}
		return null;
	}
	
	public function Listar(){
		
		$semestre = array();
		try{
			$sql = "SELECT * FROM Semestre;";
			$stmt = $this -> pdo -> prepare($sql);
			$stmt -> execute();
			
			$i = 0;
			while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
				$semestre[$i] = new Semestre();
				$semestre[$i] -> setIDSemestre($linha['idSemestre']);
				$semestre[$i] -> setSemestre($linha['semestre']);
				$semestre[$i] -> setAno($linha['ano']);
				$semestre[$i] -> setDisciplina_idDisciplina($linha['Disciplina_idDisciplina']);
				
				$i++;
			}
			
			return $semestre;
		}catch(Exception $ex){
			echo 'ERRO: ' . $ex -> getMessage();
		}
		return null;
	}
	
	public function TotalRegistro(){
		
		try{
			$sql = "SELECT COUNT(*) AS total FROM Semestre;";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			
			if($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
				return $linha['total'];
			}
		}catch(Exception $ex){
			echo 'ERRO: ' . $ex -> getMessage();
		}
	}
	
	public function UltimoInserido(){
		try{
			$sql = 'SELECT MAX(idSemestre) AS idSemestre FROM Semestre;';
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			
			if($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
				return $linha['idSemestre'];
			}
		}catch(PDOException $e){
			echo 'ERRO: '.$e->getMessage();
		}
		return 0;
	}
}
