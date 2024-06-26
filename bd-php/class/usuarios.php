<?php

class Usuarios {

    private $idusuarios;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIdusuario(){         //ID
        return $this->idusuario;
    }

    public function setIdusuario($value){
        $this->idusuario = $value;
    }                                       //Fim ID

    public function getDeslogin(){          //Login
        return $this->deslogin;
    }

    public function setDeslogin($value){ 
        $this->deslogin = $value;          
    }                                       //Fim Login

    public function getDessenha(){          //Senha
        return $this->dessenha;
    }

    public function setDessenha($value){
        $this->dessenha = $value;
    }                                       //Fim Senha 

    public function getDtcadastro(){        //Data Cadastro
        return $this->dtcadastro;
    }

    public function setDtcadastro($value){
        $this->dtcadastro = $value;
    }                                       //Fim Data Cadastro 

    public function loadById($id){

        $sql = new SQL();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));

        if (count($results) > 0){

            $this->setData($results[0]);
        
        }
    }

    public static function getList(){

        $sql = new SQL();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");

    }

    public static function search($login){

        $sql = new SQL();

        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH'=>"%".$login."%"
        ));

    }

    public function login($login, $password){

        $sql = new SQL();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        if (count($results) > 0){

            $this->setData($results[0]);
        
        }

        else{
             throw new Exception("Login ou senha inválidos.");
            }

    }

    Public function insert(){

        $sql = new SQL();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha()
        ));
   
        if (count($results) > 0) {

            $this->setData($results[0]);

        }

    }

    public function update($login, $password){

        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new SQL();

        $sql->execQuery("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha(),
            ':ID'=>$this->getIdusuario()
        ));

    }

    public function delete(){
        $sql = new SQL();

        $sql->execQuery("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
            ':ID'=>$this->getIdusuario()
        ));

        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());

    }



    public function __construct($login = "", $password = ""){

        $this->setDeslogin($login);
        $this->setDessenha($password);

    }



    public function setData($data){

        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));

    }

    public function __toString(){

        return json_encode(array(

            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }

}
?>