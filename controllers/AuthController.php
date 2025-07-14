<?php
require_once __DIR__ . '/../models/UsuarioModel.php';  // Linha corrigida

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            
            $model = new UsuarioModel();
            $usuario = $model->buscarPorEmail($email);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                session_start();
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                header('Location: index.php?action=listar');
            } else {
                echo "E-mail ou senha inválidos!";
            }
        }
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?action=login');
    }
}
?>