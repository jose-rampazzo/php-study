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

            $row = $results[0];

            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
        }
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