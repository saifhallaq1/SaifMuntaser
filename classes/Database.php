<?php

class Database{
    const HOST = "localhost";
    const USER = "root";
    const PASS= "";
    const DB="db_leeo";


    private $conn;

    public function __construct()
    {
        $this->connect();
    }

    protected function setMessage($msg){
        echo "
            <script>
                alert('$msg');
            </script>
        ";
    }

    private function connect(){
        $this->conn = new mysqli(self::HOST,self::USER,self::PASS,self::DB);
        if ($this->conn->connect_errno){
            die("Database Connection is Failed" . $this->conn->connect_error);
        }
    }

    public function query($sql){
        if($res = $this->conn->query($sql)){
            //$this->setMessage("the query is excited");
            return $res;
        }else{
            return 0;
            //$this->setMessage("the query is not excited!");
        }

    }

    public function escapeString($input){
        $escapedString = $this->conn->real_escape_string($input);
        return $escapedString;
    }

    //number of rows when doing SELECT query
    public  function numRows($resultSet){
        $numRows= $resultSet->num_rows;
        if ($numRows > 0){
            $this->setMessage("numRows worked");
            return $numRows;
        }else{
            $this->setMessage("numRows didnt work");
            return 0;
        }
    }

    // Method for checking number of affected rows (when doing insert/update/delete queries etc..)
    public function affectedRows(){
        $affectedRows = $this->conn->affected_rows;
        if ($affectedRows > 0){
            $this->setMessage("affectedRows worked");
            return $affectedRows;
        }else{
            $this->setMessage("affectedRows didnt work");
            return 0;
        }
    }

    public function last_id(){
        $lastID = $this->conn->insert_id;
        if ($lastID > 0){
            $this->setMessage("lastID worked ".$lastID);
            return $lastID;
        }else{
            $this->setMessage("lastID didnt work");
            return false;
        }
    }



}

$database = new Database();

?>