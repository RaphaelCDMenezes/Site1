<?php
// Controller exclusivo do ADM: gerenciar médicos, pacientes e admins
require_once('../../lib/config.php');

if (($_SESSION['perfil'] ?? '') !== 'adm') { http_response_code(403); echo 'Acesso negado'; exit; }

$action  = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : 'painel');
$tabela  = isset($_REQUEST['tabela']) ? $_REQUEST['tabela'] : 'medico'; // medico|usuario|adm

switch ($action) {

    /* ─── Painel geral do ADM ─── */
    case 'painel':
    default:
        require_once(__AGENDAMENTO_DIR__ . 'src/view/adm/admPainel.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/adm/admJs.php');
        break;

    /* ─── Listar usuários/médicos/adms ─── */
    case 'listar':
        $dados = [];
        if ($tabela === 'medico') {
            $dados = mysqli_query($conexao,
                "SELECT m.id_medico AS id, m.nome, m.email, m.telefone, e.descricao AS especialidade
                 FROM medico m LEFT JOIN especialidade e ON e.id_especialidade = m.id_especialidade
                 ORDER BY m.nome"
            )->fetch_all(MYSQLI_ASSOC);
        } elseif ($tabela === 'usuario') {
            $dados = mysqli_query($conexao,
                "SELECT id_usuario AS id, nome, email, cpf, telefone FROM usuario ORDER BY nome"
            )->fetch_all(MYSQLI_ASSOC);
        } elseif ($tabela === 'adm') {
            $dados = mysqli_query($conexao,
                "SELECT id_adm AS id, nome, email, telefone, ativo FROM adm ORDER BY nome"
            )->fetch_all(MYSQLI_ASSOC);
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/adm/admLista.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/adm/admJs.php');
        break;

    /* ─── Formulário de edição ─── */
    case 'editar':
        $id = (int)$_REQUEST['id'];
        $row = null;
        if ($tabela === 'medico') {
            $stmt = $conexao->prepare("SELECT * FROM medico WHERE id_medico = ?");
            $stmt->bind_param('i', $id); $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();
            $especialidades = mysqli_query($conexao, "SELECT * FROM especialidade")->fetch_all(MYSQLI_ASSOC);
        } elseif ($tabela === 'usuario') {
            $stmt = $conexao->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
            $stmt->bind_param('i', $id); $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();
        } elseif ($tabela === 'adm') {
            $stmt = $conexao->prepare("SELECT * FROM adm WHERE id_adm = ?");
            $stmt->bind_param('i', $id); $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/adm/admEditar.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/adm/admJs.php');
        break;

    /* ─── Salvar edição ─── */
    case 'salvar':
        $id      = (int)$_POST['id'];
        $nome    = trim($_POST['nome']    ?? '');
        $email   = trim($_POST['email']   ?? '');
        $telefone= trim($_POST['telefone']?? '');
        $novaSenha = trim($_POST['nova_senha'] ?? '');
        $arrMsgErro = [];

        if ($tabela === 'medico') {
            $crm     = trim($_POST['crm']     ?? '');
            $id_esp  = (int)($_POST['id_especialidade'] ?? 0);
            if ($novaSenha) {
                $hash = password_hash($novaSenha, PASSWORD_DEFAULT);
                $stmt = $conexao->prepare("UPDATE medico SET nome=?,email=?,telefone=?,crm=?,id_especialidade=?,senha=? WHERE id_medico=?");
                $stmt->bind_param('sssssii', $nome,$email,$telefone,$crm,$id_esp,$hash, $id); // errado, fix abaixo
                // fix: tipo correto
                $stmt = $conexao->prepare("UPDATE medico SET nome=?,email=?,telefone=?,crm=?,id_especialidade=?,senha=? WHERE id_medico=?");
                $stmt->bind_param('ssssisi', $nome,$email,$telefone,$crm,$id_esp,$hash,$id);
            } else {
                $stmt = $conexao->prepare("UPDATE medico SET nome=?,email=?,telefone=?,crm=?,id_especialidade=? WHERE id_medico=?");
                $stmt->bind_param('sssisi', $nome,$email,$telefone,$crm,$id_esp,$id); // fix
                $stmt = $conexao->prepare("UPDATE medico SET nome=?,email=?,telefone=?,crm=?,id_especialidade=? WHERE id_medico=?");
                $stmt->bind_param('sssiii', $nome,$email,$telefone,$crm,$id_esp,$id);
            }
        } elseif ($tabela === 'usuario') {
            $cpf = trim($_POST['cpf'] ?? '');
            if ($novaSenha) {
                $hash = password_hash($novaSenha, PASSWORD_DEFAULT);
                $stmt = $conexao->prepare("UPDATE usuario SET nome=?,email=?,telefone=?,cpf=?,senha=? WHERE id_usuario=?");
                $stmt->bind_param('sssssi', $nome,$email,$telefone,$cpf,$hash,$id);
            } else {
                $stmt = $conexao->prepare("UPDATE usuario SET nome=?,email=?,telefone=?,cpf=? WHERE id_usuario=?");
                $stmt->bind_param('ssssi', $nome,$email,$telefone,$cpf,$id);
            }
        } elseif ($tabela === 'adm') {
            if ($novaSenha) {
                $hash = password_hash($novaSenha, PASSWORD_DEFAULT);
                $stmt = $conexao->prepare("UPDATE adm SET nome=?,email=?,telefone=?,senha=? WHERE id_adm=?");
                $stmt->bind_param('ssssi', $nome,$email,$telefone,$hash,$id);
            } else {
                $stmt = $conexao->prepare("UPDATE adm SET nome=?,email=?,telefone=? WHERE id_adm=?");
                $stmt->bind_param('sssi', $nome,$email,$telefone,$id);
            }
        }

        if (isset($stmt) && $stmt->execute()) {
            $arrMsgSucesso[] = 'Dados atualizados com sucesso!';
        } else {
            $arrMsgErro[] = 'Erro ao salvar alterações';
        }
        // Volta para a lista
        $dados = [];
        if ($tabela === 'medico') {
            $dados = mysqli_query($conexao, "SELECT m.id_medico AS id, m.nome, m.email, m.telefone, e.descricao AS especialidade FROM medico m LEFT JOIN especialidade e ON e.id_especialidade = m.id_especialidade ORDER BY m.nome")->fetch_all(MYSQLI_ASSOC);
        } elseif ($tabela === 'usuario') {
            $dados = mysqli_query($conexao, "SELECT id_usuario AS id, nome, email, cpf, telefone FROM usuario ORDER BY nome")->fetch_all(MYSQLI_ASSOC);
        } elseif ($tabela === 'adm') {
            $dados = mysqli_query($conexao, "SELECT id_adm AS id, nome, email, telefone, ativo FROM adm ORDER BY nome")->fetch_all(MYSQLI_ASSOC);
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/adm/admLista.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/adm/admJs.php');
        break;

    /* ─── Excluir ─── */
    case 'excluir':
        $id = (int)$_REQUEST['id'];
        if ($tabela === 'medico') {
            $stmt = $conexao->prepare("DELETE FROM medico WHERE id_medico = ?");
        } elseif ($tabela === 'usuario') {
            $stmt = $conexao->prepare("DELETE FROM usuario WHERE id_usuario = ?");
        } elseif ($tabela === 'adm') {
            $stmt = $conexao->prepare("DELETE FROM adm WHERE id_adm = ?");
        }
        if (isset($stmt)) { $stmt->bind_param('i', $id); $stmt->execute(); $arrMsgSucesso[] = 'Excluído com sucesso'; }
        else $arrMsgErro[] = 'Erro ao excluir';
        // redireciona para listar
        $dados = [];
        if ($tabela === 'medico') $dados = mysqli_query($conexao, "SELECT m.id_medico AS id, m.nome, m.email, m.telefone, e.descricao AS especialidade FROM medico m LEFT JOIN especialidade e ON e.id_especialidade = m.id_especialidade ORDER BY m.nome")->fetch_all(MYSQLI_ASSOC);
        elseif ($tabela === 'usuario') $dados = mysqli_query($conexao, "SELECT id_usuario AS id, nome, email, cpf, telefone FROM usuario ORDER BY nome")->fetch_all(MYSQLI_ASSOC);
        elseif ($tabela === 'adm') $dados = mysqli_query($conexao, "SELECT id_adm AS id, nome, email, telefone, ativo FROM adm ORDER BY nome")->fetch_all(MYSQLI_ASSOC);
        require_once(__AGENDAMENTO_DIR__ . 'src/view/adm/admLista.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/adm/admJs.php');
        break;
}
