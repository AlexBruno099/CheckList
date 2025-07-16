<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="index.php?action=login">
        <input type="text" name="email" placeholder="E-mail">
        <input type="password" name="senha" placeholder="Senha">
        <button type="submit">Entrar</button>
        <div class="mt-3 text-center">
    Não tem conta? <a href="index.php?action=cadastrar">Cadastre-se</a>
</div>
    </form>
</body>
</html>