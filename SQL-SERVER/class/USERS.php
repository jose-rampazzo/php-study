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
    
    Public function insert(){

        $sql = new SQL_SERVER();

        $results = $sql->select("EXEC create_user_5 :LOGIN, :PASSWORD, :ACCESS", array(
            ':LOGIN'=>$this->getUser_login(),
            ':PASSWORD'=>$this->getUser_password(),
            ':ACCESS'=>$this->getAccess_level()

        ));
   
        if (count($results) > 0) {

            $this->setData($results[0]);

        }

    }

    public function insertTwo($login="", $password="", $access_level=""){

        $this->setUser_login($login);
        $this->setUser_password($password);
        $this->setAccess_level($access_level);

        $sql = new SQL_SERVER();

        $sql->execQuery("EXEC create_user_5 :LOGIN, :PASSWORD, :ACCESS", array(
            ':LOGIN'=>$this->getUser_login(),
            ':PASSWORD'=>$this->getUser_password(),
            ':ACCESS'=>$this->getAccess_level()
        ));
    }


    public function update($login="", $password="", $access_level=""){

        $this->setUser_login($login);
        $this->setUser_password($password);
        $this->setAccess_level($access_level);

        $sql = new SQL_SERVER();

        $sql->execQuery("UPDATE tb_user_data SET user_login = :LOGIN, user_password = :PASSWORD
        , access_level = :ACCESS WHERE user_id = :ID", array(
            ':LOGIN'=>$this->getUser_login(),
            ':PASSWORD'=>$this->getUser_password(),
            ':ACCESS'=>$this->getAccess_level(),
            ':ID'=>$this->getUser_id()
        ));

    }

    public static function getList(){

        $sql = new SQL_SERVER();

        return $sql->select("SELECT * FROM tb_user_data ORDER BY user_login;");

    }

    public static function search($login){

        $sql = new SQL_SERVER();

        return $sql->select("SELECT * FROM tb_user_data WHERE user_login LIKE :SEARCH ORDER BY user_login", array(
            ':SEARCH'=>"%".$login."%"
        ));

    }

    public function delete(){

        $sql = new SQL_SERVER();

        $sql->execQuery("DELETE FROM tb_user_data WHERE user_id = :ID", array(
            ':ID'=>$this->getUser_id()
        ));

        $this->setUser_id(0);
        $this->setUser_login("");
        $this->setUser_password("");
        $this->setCriation_date(new DateTime());
        $this->setAccess_level("");

    }

    public function login($login, $password){

        $sql = new SQL_SERVER();

        $results = $sql->select("SELECT * FROM tb_user_data WHERE user_login = :LOGIN AND user_password = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        if (count($results) > 0 ){

            $this->setData($results[0]);

        }

        else {
            throw new Exception("Invalid login or password");
            
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