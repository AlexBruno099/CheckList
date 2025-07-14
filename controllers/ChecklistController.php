<?php
require_once __DIR__ . '/../models/ChecklistModel.php';

class ChecklistController {
    public function listar(): void {
        session_start();
        
        // Verifica se usuário está logado
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $model = new ChecklistModel();
        $tarefas = $model->listarTarefasPorUsuario($_SESSION['usuario_id']);
        
        require __DIR__ . '/../views/checklist/listar.php';
    }

    public function adicionar(): void {
        session_start();
        
        // Verifica autenticação
        if (!isset($_SESSION['usuario_id'])) {
            $_SESSION['erro'] = "Faça login para adicionar tarefas";
            header('Location: index.php?action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descricao = trim($_POST['descricao'] ?? '');
            $usuarioId = $_SESSION['usuario_id'];

            // Validações
            if (empty($descricao)) {
                $_SESSION['erro'] = "Descrição não pode ser vazia";
            } elseif (strlen($descricao) < 3) {
                $_SESSION['erro'] = "Descrição muito curta (mínimo 3 caracteres)";
            } else {
                try {
                    $model = new ChecklistModel();
                    $model->adicionarTarefa(
                        descricao: $descricao,
                        usuarioId: $usuarioId
                    );
                    $_SESSION['sucesso'] = "Tarefa adicionada com sucesso!";
                } catch (Exception $e) {
                    $_SESSION['erro'] = "Erro ao adicionar tarefa: " . $e->getMessage();
                }
            }
        }
        
        header('Location: index.php?action=listar');
        exit;
    }

    public function concluir(): void {
        session_start();
        
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if ($id !== null) {
            try {
                $model = new ChecklistModel();
                // Verifica se a tarefa pertence ao usuário antes de concluir
                if ($model->tarefaPertenceAoUsuario($id, $_SESSION['usuario_id'])) {
                    $model->concluirTarefa($id);
                    $_SESSION['sucesso'] = "Tarefa concluída!";
                } else {
                    $_SESSION['erro'] = "Tarefa não encontrada ou permissão negada";
                }
            } catch (Exception $e) {
                $_SESSION['erro'] = "Erro ao concluir tarefa: " . $e->getMessage();
            }
        }
        
        header('Location: index.php?action=listar');
        exit;
    }

    public function remover(): void {
        session_start();
        
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if ($id !== null) {
            try {
                $model = new ChecklistModel();
                // Verifica se a tarefa pertence ao usuário antes de remover
                if ($model->tarefaPertenceAoUsuario($id, $_SESSION['usuario_id'])) {
                    $model->removerTarefa($id);
                    $_SESSION['sucesso'] = "Tarefa removida!";
                } else {
                    $_SESSION['erro'] = "Tarefa não encontrada ou permissão negada";
                }
            } catch (Exception $e) {
                $_SESSION['erro'] = "Erro ao remover tarefa: " . $e->getMessage();
            }
        }
        
        header('Location: index.php?action=listar');
        exit;
    }
}