<?php

require_once("config.php");

//Criar diretório
$dir = new fileManager("Second_Dir");
$dir->createDirectory();

//Criar diretório, arquivo e escrever um texto no arquivo
//$manager = new fileManager("home", "task");
//$manager->write("2 - Manutenção da computador 004");

//Criar um arquivo e deletar
//$manager = new fileManager("home", "test");
//$manager->delete();


//Criar arquivo Csv com dados da tabalea do banco SQL
//$manager = new fileSql("teste");
//$manager->sqlCsv();

//Transforma os dados no arquivo csv em json
//$manager = new fileSql("teste.csv");
//$manager->getUsersCsv();

//consultar um CEP
//$manager = new cep(83040300);
//$manager->getSep("");