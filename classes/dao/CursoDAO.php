<?php
require_once 'classes/Curso.class.php';
require_once 'classes/Conexao.class.php';
class CursoDAO {
    public function __construct() {
        $this -> con = new Conexao() ;
        $this -> pdo = $this -> con -> Connect();
    }
    
    public function Inserir(Curso $curso){
        try{
            $sql = 'INSERT INTO Curso VALUES (DEFAULT, :curso);';
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindValue(":curso", $curso->getCurso());
            
            return $stmt -> execute();
        } catch (Exception $ex) {
            echo 'ERRO: ' . $ex ->getMessage();
        }
		return false;
    }
	
	public function Alterar(Curso $curso){
        try{
            $sql = 'UPDATE Curso SET curso = :curso WHERE idCurso = :id;';
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindValue(":curso", $curso->getCurso());
			$stmt -> bindValue("id", $curso->getIDCurso());
            
            return $stmt -> execute();
        } catch (Exception $ex) {
            echo 'ERRO: ' . $ex ->getMessage();
        }
		return false;
    }
	
	public function Deletar(int $idCurso){
        try{
            $sql = 'DELETE FROM Curso WHERE idCurso = :id;';
            $stmt = $this -> pdo -> prepare($sql);
			$stmt -> bindValue(":id", $idCurso);
            
            return $stmt -> execute();
        } catch (Exception $ex) {
            //echo 'ERRO: ' . $ex ->getMessage();
			return false;
        }
		return false;
    }
	
	public function Pesquisar(int $idCurso){
		$curso = new Curso();
        try{
            $sql = 'SELECT * FROM Curso WHERE idCurso = :id;';
            $stmt = $this -> pdo -> prepare($sql);
			$stmt -> bindValue(":id", $idCurso);
            $stmt -> execute();
			
			if($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
				$curso -> setIDCurso($linha['idCurso']);
				$curso -> setCurso($linha['curso']);
				
				return $curso;
			}
        } catch (Exception $ex) {
            echo 'ERRO: ' . $ex ->getMessage();
        }
		return null;
    }
	
	public function Listar(){
		$curso = array();
        try{
            $sql = 'SELECT * FROM Curso ORDER BY curso;';
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> execute();
			
			$i = 0;
			while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
				$curso[$i] = new Curso();
				$curso[$i] -> setIDCurso($linha['idCurso']);
				$curso[$i] -> setCurso($linha['curso']);
				
				$i++;
			}
			return $curso;
        } catch (Exception $ex) {
            echo 'ERRO: ' . $ex ->getMessage();
        }
		return null;
    }
	
	public function TotalRegistro(){
		try{
			$sql = "SELECT COUNT(*) AS total FROM Curso;";
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
