<?php
/** 
*  Classe Contato - baseado no modelo Active Record (Simplificado) 
* @author Dêmis Carlos
* Esta classe representará uma linha da tabela contatos e ao mesmo tempo possuirá 
* métodos básicos de CRUD para operar a tabela, ou seja, é nosso MODEL

* Esta classe é composta pelos métodos de CRUD:
* Save – Insere um novo registro ou atualiza um registro – Atua tanto como CREATE como UPDATE do CRUD.
* Destroy – Exclui um registro da tabela. Atua como o DELETE do CRUD.
* Find – Localiza um registro conforme o id informado. Atua como READ do CRUD.
* All – Listar todos registros da tabela. Também atua como READ do CRUD.
* Count – É um método bonus para firula! Mostra a quantidade de registros na tabela. Acaba tendo um certo princípio de funcionalidade READ do CRUD.

* Há alguns métodos auxiliares:
* Preparar – Irá retornar um array com dados no formato perfeito para se criar a query 
*            para Inserir ou Atualizar os dados. Este método dá suporte ao método save.
* Escapar – Irá verificar cada atributo da classe Modelo, ou seja a própria classe Contato 
*            e irá escapar ou tornar os dados aceitáveis para sintaxe SQL. Este método dá suporte ao método Preparar.

* Os atributos são dinâmicos. Não são declarados explicitamente na classe Modelo. 
* Isso quer dizer que você não encontrará um atributo “nome”. Estes atributos são criados 
* dinamicamente em um super atributo do tipo array, chamado simplesmente “atributos”. 
* Para esta façanha foram usados os métodos mágicos _set(), _get() e _isset().
*/

/**

 */
class Usuario
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

    public function __isset($atributo)
    {
        return isset($this->atributos[$atributo]);
    }

    /**
     * Salvar os dados de usuario
     * @return boolean
     */
    public function save()
    {
        $colunas = $this->preparar($this->atributos);
        if (!isset($this->id)) {
            $query = "INSERT INTO usuario (".
                implode(', ', array_keys($colunas)).
                ") VALUES (".
                implode(', ', array_values($colunas)).");";
        } else {
            foreach ($colunas as $key => $value) {
                if ($key !== 'id') {
                    $definir[] = "{$key}={$value}";
                }
            }
            $query = "UPDATE usuario SET ".implode(', ', $definir)." WHERE id='{$this->id}';";            
        }
        if ($conexao = Conexao::getInstance()) {
            $stmt = $conexao->prepare($query);
            if ($stmt->execute()) {
                return $stmt->rowCount();
            }
        }
        return false;
    }
    private function escapar($dados)
    {
        if (is_string($dados) & !empty($dados)) {
            return "'".addslashes($dados)."'";
        } elseif (is_bool($dados)) {
            return $dados ? 'TRUE' : 'FALSE';
        } elseif ($dados !== '') {
            return $dados;
        } else {
            return 'NULL';
        }
    }

    /**
     * Verifica se dados são próprios para ser salvos
     * @param array $dados
     * @return array
     */
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
    public static function all()
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM usuario;");
        $result  = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Usuario::class)) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
        }
        return false;
    }
    public static function count()
    {
        $conexao = Conexao::getInstance();
        $count   = $conexao->exec("SELECT count(*) FROM usuario;");
        if ($count) {
            return (int) $count;
        }
        return false;
    }
    public static function find($id)
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM usuario WHERE id='{$id}';");
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetchObject('Usuario');
                if ($resultado) {
                    return $resultado;
                }
            }
        }
        return false;
    }
    public static function destroy($id)
    {
        $conexao = Conexao::getInstance();
        if ($conexao->exec("DELETE FROM usuario WHERE id='{$id}';")) {
            return true;
        }
        return false;
    }
}