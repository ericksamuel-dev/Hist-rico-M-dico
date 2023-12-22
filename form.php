<?php 
/*Essa é nossa view de formulário, para que
o usuário possa preencher e enviar dados referentes
ao paciente (nome, cpf, telefone e endereco) para o 
controlador*/
?>

<h1><a href="?controller=PacienteController&method=listar">Pacientes </a> | <a href="?controller=UsuarioController&method=listar">Usuarios </a></h1>
<div class="container">
    <form action="?controller=pacientecontroller&<?php echo isset($paciente->id) ? "method=atualizar&id={$paciente->id}" : "method=salvar"; ?>" method="post" >
        <div class="card" style="top:40px">
            <div class="card-header">
                <span class="card-title">Paciente</span>
            </div>
            <div class="card-body">
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Nome:</label>
                <input type="text" class="form-control col-sm-8" name="nome" id="nome" value="<?php
                echo isset($paciente->nome) ? $paciente->nome : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">CPF:</label>
                <input type="number" class="form-control col-sm-8" name="cpf" id="cpf" value="<?php
                echo isset($paciente->cpf) ? $paciente->cpf : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Telefone:</label>
                <input type="number" class="form-control col-sm-8" name="tefone" id="telefone" value="<?php
                echo isset($paciente->telefone) ? $paciente->telefone : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Endereço:</label>
                <input type="text" class="form-control col-sm-8" name="endereco" id="endereco" value="<?php
                echo isset($paciente->endereco) ? $paciente->endereco : null;
                ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Histórico:</label>
                <input type="text" class="form-control col-sm-8" name="historico" id="historico" value="<?php
                echo isset($paciente->historico) ? $paciente->historico : null;
                ?>" />
            </div>
            
            <div class="card-footer">
                <input type="hidden" name="id" id="id" value="<?php echo isset($paciente->id) ? $paciente->id : null; ?>" />
                <button class="btn btn-success" type="submit">Salvar</button>
                <button class="btn btn-secondary" type="reset">Limpar</button>
                <a class="btn btn-danger" href="?controller=PacienteController&method=listar">Cancelar</a>
            </div>
        </div>
    </form>
</div>