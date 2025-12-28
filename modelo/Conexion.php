<?php
class Conexion{
    private $host;
    private $user;
    private $password;
    private $db;
    private $charset;

    public function __construct(){
        $this->host     = 'localhost';
        $this->db       = 'liga';
        $this->user     = 'root';
        $this->password = "";
        $this->charset  = 'utf8mb4';
    }
    public function connect(){
        try{
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $PDO = new PDO($connection, $this->user, $this->password, $options);
            return $PDO;
        } catch(PDOException $e){
            print_r('Error connection' . $e->getMessage());
        }
    }
}