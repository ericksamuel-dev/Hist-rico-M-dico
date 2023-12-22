<h1><a href="?controller=PacienteController&method=listar">Contatos </a> | <a href="?controller=UsuarioController&method=listar">Usuarios </a></h1>
<hr>
<div class="container">
    <table class="table table-bordered table-striped" style="top:40px;">
        <thead>
            <tr>
                <th>Nome de Usuário</th>
                <th>Senha</th>
                <th>Privilégio</th>
                <th><a href="?controller=UsuarioController&method=criar" class="btn btn-success btn-sm">Novo</a></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $login_cookie = $_COOKIE['usuario'];
                if(isset($login_cookie)){
                    echo"Bem-Vindo, $login_cookie <br>";    
                    
                    if ($usuario) {
                        foreach ($usuario as $usuario) {
                            ?>
                            <tr>
                                <td><?php echo $usuario->nome_usuario; ?></td>
                                <td><?php echo hash('sha256', $usuario->senha); ?></td>
                                <td><?php echo $usuario->privilegio; ?></td>
                                <td>
                                    <a href="?controller=UsuarioController&method=editar&id=<?php echo $usuario->id; ?>" class="btn btn-primary btn-sm">Editar</a>
                                    <a href="?controller=UsuarioController&method=excluir&id=<?php echo $usuario->id; ?>" class="btn btn-danger btn-sm">Excluir</a>
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