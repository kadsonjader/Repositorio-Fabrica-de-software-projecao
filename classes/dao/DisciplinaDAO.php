<?php
require_once 'classes/Conexao.class.php';
require_once 'classes/Semestre.class.php';
class DisciplinaDAO {
	
	public function __construct() {
        $this -> con = new Conexao() ;
        $this -> pdo = $this -> con -> Connect();
    }
	
	public function Inserir(Disciplina $disciplina){
		try{
            $sql = 'INSERT INTO Disciplina VALUES (DEFAULT, :disciplina, :status, :idCurso);';
            $stmt = $this -> pdo -> prepare($sql);
			$stmt -> bindValue(":disciplina", $disciplina->getDisciplina());
			$stmt -> bindValue(":status", $disciplina->getStatus());
			$stmt -> bindValue(":idCurso", $disciplina->getCurso_idCurso());
            
            return $stmt -> execute();
        } catch (Exception $ex) {
            echo 'ERRO: ' . $ex -> getMessage();
        }
		return false;
	}
	
	public function Alterar(Disciplina $disciplina){
		try{
            $sql = 'UPDATE Disciplina SET disciplina = :disciplina, status = :status, Curso_idCurso = :idCurso 
					WHERE idDisciplina = :id;';
            $stmt = $this -> pdo -> prepare($sql);
			$stmt -> bindValue(":disciplina", $disciplina->getDisciplina());
			$stmt -> bindValue(":status", $disciplina->getStatus());
			$stmt -> bindValue(":idCurso", $disciplina->getCurso_idCurso());
			$stmt -> bindValue(":id", $disciplina->getIDDisciplina());
			
            
            return $stmt -> execute();
        } catch (Exception $ex) {
            echo 'ERRO: ' . $ex -> getMessage();
        }
		return false;
	}
	
	public function Deletar(int $idDisciplina){
        try{
            $sql = "UPDATE Disciplina SET status = 'D' WHERE idDisciplina = :id;";
            $stmt = $this -> pdo -> prepare($sql);
			$stmt -> bindValue(":id", $idDisciplina);
            
            return $stmt -> execute();
        } catch (Exception $ex) {
            //echo 'ERRO: ' . $ex ->getMessage();
			return false;
        }
		return false;
    }
	
	public function Pesquisar(int $idDisciplina){
		$disc = new Disciplina();
        try{
            $sql = "SELECT * FROM Disciplina AS d INNER JOIN Curso AS c ON d.Curso_idCurso = c.idCurso 
					WHERE d.idDisciplina = :id AND d.status = 'A';";
            $stmt = $this -> pdo -> prepare($sql);
			$stmt -> bindValue(":id", $idDisciplina);
            $stmt -> execute();
			
			if($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
				$disc -> setIDDisciplina($linha['idDisciplina']);
				$disc -> setDisciplina($linha['disciplina']);
				$disc -> setStatus($linha['status']);
				$disc -> setCurso_idCurso($linha['Curso_idCurso']);
				$disc -> setIDCurso($linha['idCurso']);
				$disc -> setCurso($linha['curso']);
				
				return $disc;
			}
        } catch (Exception $ex) {
            echo 'ERRO: ' . $ex ->getMessage();
        }
		return null;
    }
	
	public function Listar(){
		$disc = array();
        try{
            $sql = "SELECT * FROM Disciplina AS d INNER JOIN Curso AS c ON d.Curso_idCurso = c.idCurso 
					WHERE status = 'A'
					ORDER BY d.Curso_idCurso, d.disciplina;";
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> execute();
			
			$i = 0;
			while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
				$disc[$i] = new Disciplina();
				$disc[$i] -> setIDDisciplina($linha['idDisciplina']);
				$disc[$i] -> setDisciplina($linha['disciplina']);
				$disc[$i] -> setStatus($linha['status']);
				$disc[$i] -> setCurso_idCurso($linha['Curso_idCurso']);
				$disc[$i] -> setIDCurso($linha['idCurso']);
				$disc[$i] -> setCurso($linha['curso']);
				
				$i++;
			}
			return $disc;
        } catch (Exception $ex) {
            echo 'ERRO: ' . $ex ->getMessage();
        }
		return null;
    }
}
?>