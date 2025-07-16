<?php include __DIR__ . '/../views/layout.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Cadastre-se</h2>
            
            <?php if (isset($_SESSION['erro'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['erro'] ?></div>
                <?php unset($_SESSION['erro']); ?>
            <?php endif; ?>

            <form method="POST" action="index.php?action=cadastrar">
                <div class="mb-3">
                    <label class="form-label">Nome Completo</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" required minlength="6">
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirme sua Senha</label>
                    <input type="password" name="confirmacao_senha" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
            </form>
            
            <div class="mt-3 text-center">
                Já tem conta? <a href="index.php?action=login">Faça login</a>
            </div>
        </div>
    </div>
</div>