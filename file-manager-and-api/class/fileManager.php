<?php

class fileManager {

    public $fileName;
    public $dirName;


    public function __construct($dirName, $fileName ="") {

        $this->dirName = $dirName;
        $this->fileName = $fileName;
        
    }


    public function createDirectory() {

        if(!is_dir($this->dirName)) {
            mkdir ($this->dirName);
            echo "Diretório criado!<br>\n";
        }

        else {   
            echo "O Diretório $this->dirName já existe!<br>\n";
        }   
    }

    public function write($text) {
        
        $this->createDirectory();

        $filePath = $this->dirName . DIRECTORY_SEPARATOR . $this->fileName . ".txt";
        
        $file = fopen("$filePath", "w+");

        fwrite($file, "$text");

        fclose($file);
                
    }

    public function delete() {

        $this->write("teste");

        echo "Arquivo $this->fileName criado em $this->dirName! <br>\n";

        foreach (scandir($this->dirName) as $item) {
        
            if(!in_array($item, array(".", ".."))) {

                sleep(5);
                
                unlink($this->dirName . DIRECTORY_SEPARATOR . $item);

            }

        }

        echo "Arquivo deletado!";

    }

}

?>