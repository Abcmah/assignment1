<?php
class Database{
    private $server = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'web_assign1';
    private $conn;
    public function connect(){
        $this->conn = null;
        try{
            $this->conn = new PDO('mysql:host=' . $this->server . ';dbname=' . $this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
        }catch(PDOException $e){
            die('connection failed'.$e->getMessage());
        } 
        return $this->conn;   
    }
}
?>