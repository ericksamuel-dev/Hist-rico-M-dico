<?php
/** classe ContatosController que é o controller de usuarios
* Os métodos que essa classe possui:
* Listar – O controller deve buscar com a Model uma lista de contatos e enviar para View.
* Criar – O controller deve prover um meio para que o usuário entre com um novo contato, 
*         então solicita a view para exibir um formulário.
* Editar – O controller deve buscar um contato solicitado pelo usuário, contatando a Model 
*          para isso e deve exibir isso para o usuário, enviando para a View.
* Salvar – O controller deve salvar um contato novo criado pelo usuário no formulário da View. 
*          Controller recebe os dados através de uma requisição post e envia os dados para a Model salvar no banco de dados.
* Atualizar – Funciona parecido com Salvar, a diferença é que o Controller deve pedir a model 
*             um contato a ser atualizado, e enviar para model o contato atualizado, que será salvo no banco de dados. 
*            Em outras palavras, o Controller vai localizar o contato que o usuário quer atualizar e faz isso por pedir a Model, 
*            utilizando seu método Find. Quando tiver um contato, lança os dados atualizados nele, conformes recebidos por um “Request”. 
*            Usa novamente a Model para salvar os dados no banco.
* Excluir – O controller deve solicitar a Model a exclusão de um contato, conforme selecionado 
*           pelo usuário na Grade de listagem de contatos. 
*/
class UsuarioController extends Controller
{

    /**
     * Lista os usuarios
     */
    public function listar()
    {
        $usuario = Usuario::all();
        return $this->view('usuarioGrade', ['usuario' => $usuario]);
    }

    /**
     * Mostrar formulario para criar um novo usuario
     */
    public function criar()
    {
        return $this->view('usuarioForm');
    }

    /**
     * Mostrar formulário para editar um usuario
     */
    public function editar($dados)
    {
        $id      = (int) $dados['id'];
        $usuario = Usuario::find($id);

        return $this->view('usuarioForm', ['usuario' => $usuario]);
    }

    /**
     * Salvar o contato submetido pelo formulário
     */
    public function salvar()
    {
        $usuario           = new Usuario;
        $usuario->nome_usuario     = $this->request->nome_usuario;
        $usuario->senha = hash('sha256', $this->request->senha);
        $usuario->privilegio    = $this->request->privilegio;
        if ($usuario->save()) {
            return $this->listar();
        }
    }

    /**
     * Atualizar o usuario conforme dados submetidos
     */
    public function atualizar($dados)
    {
        $id                = (int) $dados['id'];
        $usuario           = Usuario::find($id);
        $usuario->nome_usuario     = $this->request->nome_usuario;
        $usuario->senha = hash('sha256', $this->request->senha);
        $usuario->privilegio    = $this->request->privilegio;
        $usuario->save();

        return $this->listar();
    }

    /**
     * Apagar um usuario conforme o id informado
     */
    public function excluir($dados)
    {
        $id      = (int) $dados['id'];
        $usuario = Usuario::destroy($id);
        return $this->listar();
    }
}