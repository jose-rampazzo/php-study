<?php

class fileSql {
    
    public $fileName;

    public function __construct($fileName) {

        $this->fileName = $fileName;
    }


    public function sqlCsv() {

        require_once("config.php");

        $sql = new SQL_SERVER();

        $users  = $sql->select("SELECT * FROM tb_user_data ORDER BY user_login");

        $headers = array();

        foreach ($users[0] as $key => $value) {
            array_push($headers, ucfirst($key));
        }

        $file = fopen("$this->fileName" . ".csv", "w+");

        fwrite($file, implode(",", $headers). "\r\n");

        foreach ($users as $row) {
            
            $data = array();

            foreach ($row as $key => $value) {
                
                array_push($data, $value);

            }

            fwrite($file, implode(",", $data) . "\r\n");

        }

        fclose($file);

        echo"Arquivo criado!";

    }


    public function getUsersCsv() {

        if (file_exists($this->fileName)) {

            $file = fopen($this->fileName, "r");

            $headers = explode(",", fgets($file));

            $data = array();

            while ($row = fgets($file)) {
        
                $rowData = explode(",", $row);
                $line = array();
        
                for ($i=0; $i< count($headers); $i++) {
                    
                    $line[$headers[$i]] = $rowData[$i];
                    
                }
        
                array_push($data, $line);
        
            }
        
        fclose($file);

        echo json_encode($data);
        
        }

        else {
            echo json_encode(["error" => "File not found."]);
        }
        
    }

}

?>