<?php
/*Esta classe é o nosso controlador principal e será
extendida (herança) para os controllers específicos*/

class Controller{
    public  $request;

    //Método construtor
    public function __construct()
    {
        $this->request = new Request;
    }

    //Método para chamada dos arquivos com os modelos necessários
    public function view($arquivo, $array = null){
        if(!is_null($array)){
            foreach($array as $var => $value){
                ${$var} = $value;
            }
        }
        ob_start(); //Esta função ativará o buffer de saída
        include "{$arquivo}.php";
        ob_flush(); //Limpa o buffer        
    }
}

?>
