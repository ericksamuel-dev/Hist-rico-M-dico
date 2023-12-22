<?php
    /*Este método é utilizado para dar suporte ao nosso controlador, recebendo requisições do usuário 
    enviando para o controlador buscar no modelo e então devolvendo para a view, e assim, o suário visualizar*/

    class Request{
        protected $request;

        public function __construct(){
            $this->request = $_REQUEST;
        }

        public function __get($dado){
            if(isset($this->request[$dado])){
                return $this->request[$dado];
            }
            return false;
        }
    }
?>