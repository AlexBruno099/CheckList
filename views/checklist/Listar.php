<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Checklist de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1 class="mb-4">📋 Checklist</h1>
    
    <!-- Formulário para adicionar tarefa -->
    <form action="index.php?action=adicionar" method="POST" class="mb-4">
        <div class="input-group">
            <input type="text" name="descricao" class="form-control" placeholder="Nova tarefa..." required>
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
    </form>

    <!-- Lista de tarefas -->
    <ul class="list-group">
        <?php foreach ($tarefas as $tarefa): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="<?= $tarefa['concluida'] ? 'text-decoration-line-through' : '' ?>">
                    <?= htmlspecialchars($tarefa['descricao']) ?>
                </span>
                <div>
                    <a href="index.php?action=concluir&id=<?= $tarefa['id'] ?>" class="btn btn-sm btn-success">✓</a>
                    <a href="index.php?action=remover&id=<?= $tarefa['id'] ?>" class="btn btn-sm btn-danger">✕</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php if (isset($_SESSION['sucesso'])): ?>
    <div class="alert alert-success"><?= $_SESSION['sucesso'] ?></div>
    <?php unset($_SESSION['sucesso']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['erro'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['erro'] ?></div>
    <?php unset($_SESSION['erro']); ?>
<?php endif; ?>
</body>
</html>