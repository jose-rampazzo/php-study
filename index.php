<?php

require_once("config.php");

//$sql = new SQL();
//$usuarios = $sql->select("SELECT * FROM tb_usuarios");
//echo json_encode($usuarios);

//carrega um usuário]
/*
$root = new Usuarios();
$root->loadById(3);
echo $root;
*/

//carrga uma lista de usuários
//$lista = Usuarios::getList();
//echo json_encode($lista);

//Carrega uma lista de usuários buscando pelo login
//$search = Usuarios::search("jo");
//echo json_encode($search);

//carrega um usuário usando o login e a senha
//$usuario = new Usuarios();
//$usuario->login("ichikawa", "kaiju*8");

//Criando novo usuário
//$usuario = new Usuarios("Alfa", "Shido34k");
//$usuario->insert();
//echo $usuario;

$usuario = new Usuarios();

$usuario->loadById(9);

$usuario->update("professor", "$%%#44");

echo $usuario;
?>