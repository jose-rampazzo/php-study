<?php

class SQL extends PDO {

    private $conection;

    public  function __construct(){

        $this->conection = new PDO("mysql:host=localhost;dbname=dbphp", "root", "");

    }

    private function setParams($statment, $parameters = array()) {

        foreach ($parameters as $key => $value) {
            
            $this->bindParam($key, $value);

        }

    }

    private function setParam($statment, $key, $value){

        $statment->bindParam($key, $value);

    }

    public function execQuery($rawQuery, $params = array()){

        $stmt = $this->conection->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;

    }

    public function select($rawQuery,  $params = array()):array{

        $stmt = $this->execQuery($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}



?>