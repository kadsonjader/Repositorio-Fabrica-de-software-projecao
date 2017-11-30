<?php

class Conexao {

    private $user;
    private $pass;
    private $host;
    private $base;
    private $file;
    public $pdo;

    public function Connect() {

        try {
            $this -> user = "root";
            $this -> pass = "";
            $this -> host = "localhost";
            $this -> base = "BD_FSW";
            
            
            $parametros = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8");

            $this -> file = "mysql:host=" . $this -> host . ";dbname=" . $this -> base;

            $this -> pdo = new PDO($this -> file, $this -> user, $this -> pass);

            $this -> pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this -> pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $this -> pdo -> setAttribute(PDO::ATTR_PERSISTENT, true);

            //$this -> pdo -> exec("SET NAMES UTF8");*/
            if (!$this -> pdo) {

                echo "Erro na conexão";

            }

            return $this -> pdo;

        } catch(PDOException $ex) {

            echo "Erro no sistema" . $ex -> getMessage();

        }
        define('DB_NAME', $this->base);
    }
}
?>