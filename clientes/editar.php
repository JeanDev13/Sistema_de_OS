<?php

    require_once "../config/conexao.php";

    $id = $_GET['id'] ?? $_POST['id'] ?? null;

    if (!$id){
        header('Location: index.php');
        exit;
    }

    $sql = "SELECT * FROM clientes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id
    ]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente){
        header('Location: index.php');
        exit;
    }

    $erros = [];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome = trim($_POST['nome'] ?? '');
        $cpf = trim($_POST['cpf'] ?? '');
        $telefone = trim($_POST['telefone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $endereco = trim($_POST['endereco'] ?? '');

        if(empty($nome)){
            $erros[] = "Nome Obrigatório!";
        }
        if(empty($cpf)){
            $erros[] = "CPF obrigatório!";
        }
        if(empty($telefone)){
            $erros[] = "Telefone obrigatório!";
        }
        if(count($erros) === 0){
            $sql = "UPDATE clientes 
                    SET nome = :nome,
                        cpf = :cpf,
                        telefone = :telefone,
                        email = :email,
                        endereco = :endereco
                    WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $nome,
                ':cpf' => $cpf,
                ':telefone' => $telefone,
                ':email' => $email !== '' ? $email :null,
                ':endereco' => $endereco !== '' ? $endereco :null,
                ':id' => $id
            ]);

            header('Location: index.php');
            exit();
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Editar</title>
</head>
<body>
    <h1>Editar Cliente</h1>
    <?php if (count($erros) > 0): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach($erros as $erro): ?>
                    <li><?= htmlspecialchars($erro)?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="editar.php" method="POST">
        <input type="hidden" name="id" value="<?=  $cliente['id'] ?>">
        <div>
            <label for="nome" class="form-label">Nome</label>
            <input class="form-control form-control-sm" value="<?= htmlspecialchars($cliente['nome']) ?>" type="text" name="nome" id="nome" placeholder="Ex: João" required>
        </div>
        <div>
            <label for="cpf" class="form-label">CPF</label>
            <input class="form-control form-control-sm" value="<?= htmlspecialchars($cliente['cpf']) ?>" type="text" name="cpf" id="cpf" placeholder="Ex: 000.000.000-00" required>
        </div>
        <div>
            <label for="telefone" class="form-label">Telefone</label>
            <input class="form-control form-control-sm" value="<?= htmlspecialchars($cliente['telefone']) ?>"  type="text" name="telefone" id="telefone" placeholder="Ex: (33)33333-3333" required>
        </div>
        <div>
            <label for="email" class="form-label">E-mail</label>
            <input class="form-control form-control-sm" value="<?= htmlspecialchars($cliente['email'] ?? '') ?>"  type="email" name="email"  id="email" placeholder="Ex: joao@gmail.com">
        </div>
        <div>
            <label for="endereco" class="form-label">Endereço</label>
            <input class="form-control form-control-sm" value="<?= htmlspecialchars($cliente['endereco'] ?? '') ?>" type="text" name="endereco" id="endereco" placeholder="Ex: Praça das araras">
        </div>
        <button type="submit" class="btn btn-success">Editar</button>
        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </form>
    
</body>
</html>