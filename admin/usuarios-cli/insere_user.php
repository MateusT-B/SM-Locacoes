<?php
include '../acesso_com.php'; // Verifica acesso
include '../../banco/connect.php'; // Conecta ao banco de dados

error_reporting(0); // Desativa a exibição de erros

session_start();

// Verifica se o id_cliente está na sessão
if (!isset($_SESSION['id_cliente']) || empty($_SESSION['id_cliente'])) {
    die("Erro: ID do cliente não encontrado.");
}

$idCliente = $_SESSION['id_cliente']; // Pega o id_cliente da sessão

if ($_POST) {
    // Obtendo os dados enviados pelo formulário
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $ativo = $_POST['ativo'];

    // Inserindo dados na tabela `usuarios`
    $stmtUsuario = $conn->prepare("INSERT INTO usuarios_clientes_web (id_cliente, usuario, senha, ativo) VALUES (?, ?, MD5(?), ?)");
    $stmtUsuario->bind_param('isss', $idCliente, $usuario, $senha, $ativo);
    $resultadoUsuario = $stmtUsuario->execute();

    if ($resultadoUsuario) {
        header('Location: lista_usuarios-cli.php'); // Redireciona para a lista de usuários
        exit;
    } else {
        echo "Erro ao inserir usuário: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/estilo.css">
    <link rel="shortcut icon" href="../../img/favicon1.png" type="image/png">
    <title>SMLocações - Inserir User</title>
</head>
<body>
<?php include "../menu_adm_op.php";?>
<main class="container-inserir mx-auto">
    <div class="mx-auto">
        <div class="col-xs-12 col-sm-offset-2 col-sm-6 col-md-8 mx-auto">
            <h2 class="breadcrumb-insere alert text-warning">
                <a href="lista_user.php">
                    <button class="btn btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </button>
                </a>
                Inserindo User
            </h2>
            <div class="thumbnail-insere">
                <div class="alert alert-warning" role="alert">
                    <form action="insere_user.php" method="post" name="form_insere" enctype="multipart/form-data" id="form_insere">

                        <!-- Dados do Cliente -->
                        <label for="usuario">Usuário:</label>
                        <div class="input-group">
                        <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                </svg>
                            </span>
                            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Digite o usuario: " required>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha:</label>
                            <div class="input-group">
                            <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                        </svg>
                                    </span>
                                    <input type="password" class="form-control" id="senha" name="senha" maxlength="11" class="form-control" placeholder="Digite sua senha: " required>
                                </div>
                        </div>

                        <label for="ativo">Ativo:</label>
                        <div class="input-group-text">
                        <span class="input-group-addon">
                            <label for="ativo_s" class="radio-inline">
                                <input type="radio" name="ativo" id="ativo" value="Sim">Sim
                            </label>
                            <label for="ativo_s" class="radio-inline">
                                <input type="radio" name="ativo" id="ativo" value="Nao" checked>Não
                            </label>
                        </div>

                        <br>
                        <button href="insere_contatos.php" type="submit" class="btn btn-warning">Avançar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>

