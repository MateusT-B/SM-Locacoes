<?php
include '../acesso_com.php';
include '../../banco/connect.php';
if($_POST) 
{
    $nome = $_POST['nome'];
    $cpf = preg_replace('/[.\-]/', '', $_POST['cpf']);
    $data_nascimento = $_POST['data_nascimento'];
    $data_cad = date('Y-m-d H:i:s'); // Data atual para cadastro

    $insereCliente = "insert clientes 
                    (nome, cpf, data_nascimento, data_cad)
                    values
                    ('$nome','$cpf', '$data_nascimento', '$data_cad') 
                    ";
    $resultadoCliente = $conn->query($insereCliente);
    if ($resultadoCliente) 
    {
        $idCliente = mysqli_insert_id($conn); // Pega o último ID inserido
        // Salva o ID na sessão para usar nas próximas etapas
        session_start();
        $_SESSION['id_cliente'] = $idCliente;
        header('Location: insere_enderecos.php'); // Redireciona para a próxima etapa
    exit;
    } else {
        echo "Erro ao inserir cliente: " . $conn->error;
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
    <title>SMLocações - Inserir Cliente</title>
</head>
<body>
<?php include "../menu_adm_op.php";?>
<main class="container-inserir mx-auto">
    <div class="mx-auto">
        <div class="col-xs-12 col-sm-offset-2 col-sm-6 col-md-8 mx-auto">
            <h2 class="breadcrumb-insere alert text-warning">
                <a href="lista_usuarios-cli.php">
                    <button class="btn btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </button>
                </a>
                Inserindo Cliente
            </h2>
            <div class="thumbnail-insere">
                <div class="alert alert-warning" role="alert">
                    <form action="insere_clientes.php" method="post" name="form_insere" enctype="multipart/form-data" id="form_insere">

                        <!-- Dados do Cliente -->
                        <label for="nome">Nome:</label>
                        <div class="input-group">
                        <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                </svg>
                            </span>
                            <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome do cliente" required>
                        </div>

                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF:</label>
                            <div class="input-group">
                            <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11" class="form-control" placeholder="Digite seu CPF" required>
                                </div>
                        </div>
                        <!-- Adicione jQuery -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                        <!-- Adicione o jQuery Mask Plugin -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
                        <!-- Máscara para o campo de CPF -->
                        <script>
                            $(document).ready(function() {
                                $('#cpf').mask('000.000.000-00');
                            });
                        </script>

                        <label for="data_nascimento">Data de Nascimento:</label>
                        <div class="input-group">
                        <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                </svg>
                            </span>
                            <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" required>
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
