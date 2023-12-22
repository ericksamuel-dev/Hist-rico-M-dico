<?php
    /*Esta é a nossa view para listagem dos pacientes
    que o usuário envia através da view do formulário */
?>

<h1><a href="?controller=PacienteController&method=listar">Pacientes </a> | <a href="?controller=UsuarioController&method=listar">Usuarios </a></h1>
<hr>
<div class="container">
    <table class="table table-bordered table-striped" style="top:40px;">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Histórico</th>
                <th><a href="?controller=PacienteController&method=criar" class="btn btn-success btn-sm">Novo</a></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $login_cookie = $_COOKIE['usuario'];
                if(isset($login_cookie)){
                    echo"Bem-Vindo, $login_cookie <br>";
                    
                    if ($paciente){
                        foreach ($paciente as $paciente) {
                            ?>
                            <tr>
                                <td><?php echo $paciente->nome; ?></td>
                                <td><?php echo $paciente->cpf; ?></td>
                                <td><?php echo $paciente->telefone; ?></td>
                                <td><?php echo $paciente->endereco; ?></td>
                                <td><?php echo $paciente->historico; ?></td>
                                <td>
                                    <a href="?controller=PacienteController&method=editar&id=<?php echo $paciente->id; ?>" class="btn btn-primary btn-sm">Editar</a>
                                    <a href="?controller=PacienteController&method=excluir&id=<?php echo $paciente->id; ?>" class="btn btn-danger btn-sm">Excluir</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5">Nenhum registro encontrado</td>
                        </tr>
                        <?php
                    }
                    
                }else{
                    echo"Bem-Vindo, convidado <br>";
                    echo"Essas informações <font color='red'>NÃO PODEM</font> ser acessadas por você";
                    echo"<br><a href='index2.php'>Faça Login</a> Para ler o conteúdo";
                }

            
            ?>
        </tbody>
    </table>
</div>