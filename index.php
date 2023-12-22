<?php
/**Aqui temos o que chamamos de front controller, é uma espécie de controlador de rotas para um método de um controller
 * As primeiras duas linhas do código são apenas para depuração. Caso as mensagens de erros 
 * estejam desativadas nas configurações do php, estas linhas irão ativar:
 */
error_reporting(E_ALL);
ini_set('display_errors', true);

// As classes são carregadas dinamicamente, e por isso faz sentido criar um autoloader para isso.
spl_autoload_register(function($class) {
    if (file_exists("$class.php")) {
        require_once "$class.php";
        return true;
    }
});
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style2.css">
        <title>Login</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">

    </head>

    <body>
        <div id="login">
            <form action="login.php" class="card" method="post">
                <div class="card-header">
                    <h2>Login</h2>
                </div>
                <div class="card-content">
                    <div class="card-content-area">
                        <label for="usuario">Usuário</label>
                        <input type="text" name="usuario" id="usuario" autocomplete="off"/>
                    </div>
                    <div class="card-content-area">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" autocomplete="off"/>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="entrar" id="entrar" name="entrar" class="submit">
                    <a href="#" class="recuperar_senha">Esqueceu a senha?</a>
                </div>
            </form>
        </div>

        <?php
        if ($_GET) {
            $controller = isset($_GET['controller']) ? ((class_exists($_GET['controller'])) ? new $_GET['controller'] : NULL ) : null;
            $method     = isset($_GET['method']) ? $_GET['method'] : null;
            if ($controller && $method) {
                if (method_exists($controller, $method)) {
                    $parameters = $_GET;
                    unset($parameters['controller']);
                    unset($parameters['method']);
                    call_user_func(array($controller, $method), $parameters);
                } else {
                    echo "Método não encontrado!";
                }
            } else {
                echo "Controller não encontrado!";
            }
        } 
        ?>
    </body>
</html>