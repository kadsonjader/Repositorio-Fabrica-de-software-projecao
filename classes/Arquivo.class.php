<?php
require_once 'Semestre.class.php';
class Arquivo extends Semestre{
    
    
    private $idArquivo;
	private $titulo;
	private $aluno;
	private $orientador;
    private $hora;
    private $palavra_chave;
    private $caminho_arq;
    private $Semestre_idSemestre;
    private $Usuario_idUsuario;
    
    function getIDArquivo() {
        return $this->idArquivo;
    }

    function getTitulo() {
        return $this->titulo;
    }
	
	function getAluno(){
		return $this->aluno;
	}
	
	function getOrientador(){
		return $this->orientador;
	}
	
    function getHora() {
        return $this->hora;
    }

    function getPalavra_chave() {
        return $this->palavra_chave;
    }

    function getCaminho_arq() {
        return $this->caminho_arq;
    }

    function getSemestre_idSemestre() {
        return $this->Semestre_idSemestre;
    }

    function getUsuario_idUsuario() {
        return $this->Usuario_idUsuario;
    }

    function setIDArquivo($idArquivo) {
        $this->idArquivo = $idArquivo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
	
	function setAluno($aluno){
		$this->aluno = $aluno;
	}
	
	function setOrientador($orientador){
		$this->orientador = $orientador;
	}

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setPalavra_chave($palavra_chave) {
        $this->palavra_chave = $palavra_chave;
    }

    function setCaminho_arq($caminho_arq) {
        $this->caminho_arq = $caminho_arq;
    }

    function setSemestre_idSemestre($Semestre_idSemestre) {
        $this->Semestre_idSemestre = $Semestre_idSemestre;
    }

    function setUsuario_idUsuario($Usuario_idUsuario) {
        $this->Usuario_idUsuario = $Usuario_idUsuario;
    }

    
}
?>