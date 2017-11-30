<?php

require_once 'Disciplina.class.php';
class Semestre extends Disciplina{
    
   private $idSemestre;
   private $semestre;
   private $ano;
   private $Disciplina_idDisciplina;
   
   function getIDSemestre() {
       return $this->idSemestre;
   }

   function getSemestre() {
       return $this->semestre;
   }

   function getAno() {
       return $this->ano;
   }
   
   function getDisciplina_idDisciplina(){
	   return $this->Disciplina_idDisciplina;
   }

   function setIDSemestre($idSemestre) {
       $this->idSemestre = $idSemestre;
   }

   function setSemestre($semestre) {
       $this->semestre = $semestre;
   }

   function setAno($ano) {
       $this->ano = $ano;
   }
   
   function setDisciplina_idDisciplina($Disciplina_idDisciplina){
	   $this->Disciplina_idDisciplina = $Disciplina_idDisciplina;
   }
}
?>