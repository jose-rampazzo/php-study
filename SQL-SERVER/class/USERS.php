<?php

class USERS {

    private $user_id;
    private $user_login;
    private $user_password;
    private $criation_date;
    private $access_level;

    // ID
    public function getUser_id(){
        return $this->user_id;
    }

    public function setUser_id($value){
        $this->user_id = $value;
    }

    //login
    public function getUser_login(){
        return $this->user_login;
    }

    public function setUser_login($value){
        $this->user_login = $value;
    }

    //password
    public function getUser_password(){
        return $this->user_password;
    }

    public function setUser_password($value){
        $this->user_password = $value;
    }

    //data
    public function getCriation_date(){
        return $this->criation_date;
    }

    public function setCriation_date($value){
        $this->criation_date = $value;
    }

    //access level
    public function getAccess_level(){
        return $this->access_level;
    }
    
    public function setAccess_level($value){
        $this->access_level = $value;
    }

    public function loadById($id){
        
        $sql = new SQL_SERVER();

        $results = $sql->select("SELECT * FROM tb_user_data WHERE user_id = :ID", array(
            ":ID"=>$id
        ));

        if(count($results) > 0){

            $this->setData($results[0]);

        }
    }

    public function __construct($login = "", $password = ""){

        $this->setUser_login($login);
        $this->setUser_password($password);

    }


    public function setData($data){

        $this->setUser_id($data['user_id']);
        $this->setUser_login($data['user_login']);
        $this->setUser_password($data['user_password']);
        $this->setCriation_date(new DateTime($data['criation_date']));
        $this->setAccess_level($data['access_level']);

    }

    public function __toString(){

        return json_encode(array(

            "user_id"=>$this->getUser_id(),
            "user_login"=>$this->getUser_login(),
            "user_password"=>$this->getUser_password(),
            "creation_date"=>$this->getCriation_date()->format("d/m/Y H:i:s"),
            "access_level"=>$this->getAccess_level()

        ));

    }

}
?>