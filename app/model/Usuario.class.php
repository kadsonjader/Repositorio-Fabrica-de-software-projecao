<?php

class Usuario {
    private $idUsuario;
    private $login;
    private $senha;
    private $permissao;
    private $status;
    
    function getIDUsuario() {
        return $this->idUsuario;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getPermissao() {
        return $this->permissao;
    }

    function getStatus() {
        return $this->status;
    }

    function setIDUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setPermissao($permissao) {
        $this->permissao = $permissao;
    }

    function setStatus($status) {
        $this->status = $status;
    }


}
