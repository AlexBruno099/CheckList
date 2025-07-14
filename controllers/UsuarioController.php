<?php
require_once __DIR__ . '/../models/UsuarioModel.php';

class UsuarioController {
    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome']);
            $email = trim($_POST['email']);
            $senha = $_POST['senha'];
            $confirmacaoSenha = $_POST['confirmacao_senha'];

            // Validações
            if (empty($nome) || empty($email) || empty($senha)) {
                $_SESSION['erro'] = "Todos os campos são obrigatórios!";
            } elseif ($senha !== $confirmacaoSenha) {
                $_SESSION['erro'] = "As senhas não coincidem!";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['erro'] = "E-mail inválido!";
            } else {
                try {
                    $model = new UsuarioModel();
                    
                    // Verifica se e-mail já existe
                    if ($model->buscarPorEmail($email)) {
                        $_SESSION['erro'] = "E-mail já cadastrado!";
                    } else {
                        $model->cadastrar($nome, $email, $senha);
                        $_SESSION['sucesso'] = "Cadastro realizado com sucesso!";
                        header('Location: index.php?action=login');
                        exit;
                    }
                } catch (Exception $e) {
                    $_SESSION['erro'] = "Erro ao cadastrar: " . $e->getMessage();
                }
            }
        }
        require_once __DIR__ . '/../views/auth/cadastro.php';
    }
}
?>