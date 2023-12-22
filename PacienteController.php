<?php
/*Aqui temos o nosso controlador, também conhecido
como orquestrador, atravessador, "pau mandado" ou 
como queiram chamar. Esta classe é uma 
herança/filha da classe Controller*/

class PacienteController extends Controller{

    //Este método é o R do nosso CRUD
    public function listar(){
        $pacientes = Paciente::all();
        return $this->view('grade',['paciente' => $pacientes]);
    }

    //Este método é o C do nosso CRUD
    public function criar(){
        return $this->view('form');
    }

    //Este método é o D do nosso CRUD
    public function excluir($dados){
        $id = (int) $dados['id'];
        $pacientes = Paciente::destroy($id);
        return $this->listar();
    }

    //Este método é o U do nosso CRUD
    public function editar($dados){
        $id = (int) $dados['id'];
        //chamando o método buscar produto do modelo
        $pacientes = Paciente::find($id);

        return $this->view('form', ['paciente' => $pacientes]);
    }

    //Método para chamar o save() do modelo
    public function salvar(){
        $pacientes = new Paciente;
        $pacientes->nome = $this->request->nome;
        $pacientes->cpf = $this->request->cpf;
        $pacientes->telefone = $this->request->telefone;
        $pacientes->endereco = $this->request->endereco;
        $pacientes->historico = $this->request->historico;
        
        if($pacientes->save()){
            return $this->listar();
        }
    }

    //Método para atualizar a lista de produtos
    public function atualizar($dados){
        $id = (int) $dados['id'];
        $paciente = Paciente::find($id);
        $paciente->nome = $this->request->nome;
        $paciente->cpf = $this->request->cpf;
        $paciente->telefone = $this->request->telefone;
        $paciente->endereco = $this->request->endereco;
        $paciente->historico = $this->request->historico;
        
        $paciente->save();

        return $this->listar();
    }





}
?>
