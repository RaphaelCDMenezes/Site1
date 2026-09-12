USE masara;

-- Tabela de administradores
CREATE TABLE IF NOT EXISTS adm (
    id_adm    INT AUTO_INCREMENT PRIMARY KEY,
    nome      VARCHAR(100) NOT NULL,
    email     VARCHAR(100) NOT NULL UNIQUE,
    senha     VARCHAR(255) NOT NULL,
    telefone  VARCHAR(20),
    ativo     TINYINT(1) DEFAULT 1,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de planos
CREATE TABLE IF NOT EXISTS plano (
    id_plano   INT AUTO_INCREMENT PRIMARY KEY,
    nome       VARCHAR(80) NOT NULL,
    descricao  TEXT,
    preco      DECIMAL(10,2) DEFAULT 0.00,
    beneficios TEXT,
    ativo      TINYINT(1) DEFAULT 1,
    criado_em  DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Planos vinculados a pacientes
CREATE TABLE IF NOT EXISTS plano_usuario (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_plano   INT NOT NULL,
    dt_inicio  DATE,
    dt_fim     DATE,
    ativo      TINYINT(1) DEFAULT 1,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_plano)   REFERENCES plano(id_plano)     ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de consultas
CREATE TABLE IF NOT EXISTS consulta (
    id_consulta         INT AUTO_INCREMENT PRIMARY KEY,
    id_medico           INT NOT NULL,
    id_usuario          INT NOT NULL,
    dt_consulta         DATETIME NOT NULL,
    motivo              VARCHAR(255),
    status              ENUM('agendada','cancelada_medico','cancelada_paciente','realizada') DEFAULT 'agendada',
    motivo_cancelamento TEXT,
    criado_em           DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_medico)  REFERENCES medico(id_medico)   ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
