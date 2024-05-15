<?php

require_once("config.php");


//Procurar um usuario pelo ID no banco
/*
$root = new USERS();
$root->loadById(1);
echo $root;
*/

//Inserir um novo usuário no banco
//$usuario = new USERS();
//$usuario->insertTwo("professor", "$%%#44", "MOD");


//Lista o user da tabela
//$list = USERS::getList();
//echo json_encode($list);

//Procura usuário no banco pelo login
//$search = USERS::search("De");
//echo json_encode($search);

//Altera informações de um user
/*
$user = new USERS();
$user->loadById(2);
$user->update("delta", "1278@hjCid","MOD");
echo $user;
*/

//Deleta um usuário de acordo com o ID

$user_del = new USERS();
$user_del->loadById(16);
$user_del->delete();
echo $user_del;


//Load a user using this login and password
//$user = new USERS();
//$user->login("delta", "1278@hjCid");
//echo $user;


?>