<?php
require_once 'Curso.class.php';
class Disciplina extends Curso{
	
	private $idDisciplina;
	private $disciplina;
	private $status;
	private $Curso_idCurso;
	
	function getIDDisciplina() {
       return $this->idDisciplina;
   }

   function getDisciplina() {
       return $this->disciplina;
   }
   
   function getStatus() {
       return $this->status;
   }
   
   function getCurso_idCurso(){
	   return $this->Curso_idCurso;
   }
   
   function setIDDisciplina($idDisciplina) {
       $this->idDisciplina = $idDisciplina;
   }

   function setDisciplina($disciplina) {
       $this->disciplina = $disciplina;
   }
   
   function setStatus($status) {
       $this->status = $status;
   }
   
   function setCurso_idCurso($Curso_idCurso){
	   $this->Curso_idCurso = $Curso_idCurso;
   }
}
?>