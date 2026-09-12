# 🏥 Sistema de Agendamento e Gestão de Consultas

Um sistema web completo desenvolvido para simplificar a marcação de consultas médicas, gestão de especialidades, planos de saúde e administração de usuários. O projeto foi construído focando em uma experiência intuitiva tanto para pacientes quanto para médicos e administradores.

---

## 🚀 Funcionalidades

### 👤 Área do Usuário / Paciente
- **Cadastro e Autenticação:** Login e registro seguro de usuários.
- **Painel do Paciente:** Visualização de agendamentos e serviços disponíveis.
- **Agendamento de Consultas:** Escolha de especialidades, médicos e horários.
- **Perfil do Usuário:** Gestão de dados pessoais e alteração de informações.

### 👨‍⚕️ Área Administrativa e Médica
- **Gestão de Médicos:** Cadastro, edição e leitura de dados dos profissionais.
- **Especialidades e Planos:** Controle completo de especialidades médicas e planos de saúde aceitos.
- **Painel Geral:** Visão consolidada dos agendamentos, envios de e-mail e uploads do sistema.

---

## 🛠️ Tecnologias Utilizadas

- **Backend:** PHP (Arquitetura baseada em MVC — Model, View, Controller)
- **Frontend:** HTML5, CSS3, JavaScript
- **Banco de Dados:** MySQL / MariaDB
- **Controle de Versão:** Git e GitHub

---

## 📁 Estrutura do Projeto

```text
├── css/                  # Estilos do sistema
├── js/                   # Scripts e interações frontend
├── lib/                  # Configurações e scripts SQL (setup.sql, config.php)
└── src/
    ├── controller/       # Controladores (Login, E-mail, Consulta, Plano, Adm)
    ├── model/            # Modelos de dados e regras de negócio
    └── view/             # Telas e interfaces (Painel, Login, Consultas, Perfil)
