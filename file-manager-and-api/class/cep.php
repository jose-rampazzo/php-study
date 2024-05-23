<?php

class cep {

    private $cepNumber;

    public function __construct($cepNumber){

        $this->cepNumber = $cepNumber;

    }

    public function getSep($info = "") {

        $link = "https://viacep.com.br/ws/$this->cepNumber/json/";

        $ch = curl_init($link);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $response = curl_exec($ch);

        curl_close($ch);

        $data = json_decode($response, true);

        if ($info == "") {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }

        elseif (isset($data[$info]) && $data !="") {
        echo json_encode([$info => $data[$info]], JSON_UNESCAPED_UNICODE); // cria um novo JSON contendo apenas o par chave-valor desejado e imprime este JSON.
            }

        else {
            echo "Informação não encontrada.";
        }

   }

}

?>