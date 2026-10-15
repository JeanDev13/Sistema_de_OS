<?php

    require_once "../config/conexao.php";

    $erros = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nome = trim($_POST['nome'] ?? '');
        $cpf = trim($_POST['cpf'] ?? '');
        $telefone = trim($_POST['telefone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $endereco = trim($_POST['endereco'] ?? '');

        if(empty($nome)){
            $erros[] = "Nome obrigatório!";
        }
        if(empty($cpf)){
            $erros[] = "CPF obrigatório!";
        }
        if(empty($telefone)){
            $erros[] = "Telefone obrigatório!";
        }

        if(count($erros) === 0){        
            $sql = "INSERT INTO clientes(nome, cpf, telefone, email, endereco) 
                    VALUES (:nome, :cpf, :telefone, :email, :endereco)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $nome,
                ':cpf' => $cpf,
                ':telefone' => $telefone,
                ':email' => $email !== '' ? $email : null,
                ':endereco' => $endereco !== '' ? $endereco : null
            ]);

            header('Location: index.php');
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Cadastrar Cliente</title>
</head>
<body>
    <h1>Cadastrar Cliente</h1>
    <?php if($count($erros) > 0): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach($erros as $erro): ?>
                    <li><?= htmlspecialchars($erro)?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="cadastrar.php" method="POST">
        <div>
            <label for="nome" class="form-label">Nome</label>
            <input class="form-control form-control-sm" type="text" name="nome" id="nome" placeholder="Ex: João" required>
        </div>
        <div>
            <label for="cpf" class="form-label">CPF</label>
            <input class="form-control form-control-sm" type="text" name="cpf" id="cpf" placeholder="Ex: 000.000.000-00" required>
        </div>
        <div>
            <label for="telefone" class="form-label">Telefone</label>
            <input class="form-control form-control-sm" type="text" name="telefone" id="telefone" placeholder="Ex: (33)33333-3333" required>
        </div>
        <div>
            <label for="email" class="form-label">E-mail</label>
            <input class="form-control form-control-sm" type="email" name="email"  id="email" placeholder="Ex: joao@gmail.com">
        </div>
        <div>
            <label for="endereco" class="form-label">Endereço</label>
            <input class="form-control form-control-sm" type="text" name="endereco" id="endereco" placeholder="Ex: Praça das araras">
        </div>
        <br><br>
        <button type="submit" class="btn btn-success">Cadastrar</button>
        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </form>
</body>
</html>