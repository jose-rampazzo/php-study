<?php

require_once("config.php");

$root = new USERS();
$root->loadById(1);
echo $root;

?>