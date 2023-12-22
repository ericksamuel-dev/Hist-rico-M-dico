<?php
//Este arquivo é um Model no padrão MVC
class Paciente
{
    private $atributos;

    public function __construct()
    {

    }

    public function __set(string $atributo, $valor)
    {
        $this->atributos[$atributo] = $valor;
        return $this;
    }

    public function __get(string $atributo)
    {
        return $this->atributos[$atributo];
    }

    public function __isset(string $atributo)
    {
        return isset($this->atributos[$atributo]);
    }

    private function escapar($dados)
    {
        if (is_string($dados) & !empty($dados))
            return "'" . addslashes($dados) . "'";
            elseif(is_bool($dados))
                return $dados ? 'TRUE' : 'FALSE';
            elseif($dados !== '')
                return $dados;
            else
                return 'NULL';
    }
    //verifca se os dados estão prontos para salvar
    private function preparar($dados)
    {
        $resultado = array();
        foreach ($dados as $k => $v) {
            if (is_scalar($v)) {
                $resultado[$k] = $this->escapar($v);
            }
        }
        return $resultado;
    }

    public function save(){
        $colunas = $this->preparar($this->atributos);
        if(!isset($this->id)){
             $query = "INSERT INTO paciente (".
             implode(', ', array_keys($colunas)) .") VALUES (".
             implode(', ', array_values($colunas)) .");";
        }
        else{
            foreach($colunas as $key => $value) {
                if($key !== 'id')
                $definir[] = "{$key}={$value}";
            }
            $query = "UPDATE paciente SET ".
            implode(', ', $definir) ." WHERE id='$this->id';";
        }
        if($conexao = Conexao::getInstance()){
            $stmt = $conexao->prepare($query);
            if($stmt->execute()){
                return $stmt->rowCount();
            }
        }
        return false;
    }

    public static function count(){
        $conexao = Conexao::getInstance();
        $count = $conexao->exec("SELECT count(*) FROM paciente;");
        if($count){
            return (int)$count;
        }
        return false;
    }

    //Método para lsitar tudo o que tem na tabela
    public static function all()
    {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("SELECT * FROM paciente;");
        $result = array();//criando um vetor
        if($stmt->execute()){
            while($rs = $stmt->fetchObject(Paciente::class)){
                $result[] = $rs;//gravadno em um vetor
            }
        }
        if(count($result) > 0){
            return $result;//retornando vetor de produtos
        }
        return false;
    }

    //Método de apagar um produto
    public static function destroy($id){
        $conexao = Conexao::getInstance();
        if($conexao->exec("DELETE FROM paciente WHERE id='{$id}';")){
            return true;
        }
        return false;
    }

    //Método de busca na tabela produto
    public static function find($id){
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("SELECT * FROM paciente WHERE id='{$id}';");
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $resultado = $stmt->fetchObject('Paciente');
                if($resultado)
                    return $resultado;
            }
        } 
        return false;
    }
    
}
?>