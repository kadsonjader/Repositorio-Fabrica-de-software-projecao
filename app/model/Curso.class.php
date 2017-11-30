<?php 
class Curso {
	
	private $idCurso;
	private $curso;
	
	function getIDCurso() {
       return $this->idCurso;
   }

   function getCurso() {
       return $this->curso;
   }
   
   function setIDCurso($idCurso) {
       $this->idCurso = $idCurso;
   }

   function setCurso($curso) {
       $this->curso = $curso;
   }
}
?>