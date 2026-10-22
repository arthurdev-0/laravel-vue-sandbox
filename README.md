# 🏢 Laravel + Vue Sandbox (Environment Guard)

[![Laravel Version](https://shields.io)](https://laravel.com)
[![Vue Version](https://shields.io)](https://vuejs.org)
[![PHP Version](https://shields.io)](https://php.net)

Um template full-stack opinativo que resolve de forma nativa um dos maiores problemas em equipes de desenvolvimento, o clássico **"Na minha máquina funciona"**.
An opinionated full-stack template that natively solves one of the biggest problems faced by development teams: the classic "it works on my machine."

Este repositório foi construído para servir como um boilerplate seguro que impede que quebras de versão de PHP, Node ou dependências locais cheguem ao ambiente de produção ou afetem o restante do time de engenharia.
This repository was built to serve as a secure boilerplate that prevents version-related breakages—whether from PHP, Node, or local dependencies—from reaching the production environment or affecting the rest of the engineering team.

---

## 🛠️ A Dor: O Caso Real

Recentemente, enfrentei um cenário comum no mercado: ao alternar o desenvolvimento de um sistema interno de um computador corporativo para uma máquina pessoal, o ambiente local acabou atualizando a versão global do PHP silenciosamente. Ao realizar o `git commit` e enviar as atualizações, o desalinhamento de sintaxe e dependências quebrou o ecossistema local do restante da equipe e corrompeu a comunicação com o banco de dados.

Embora o Git permita reverter commits (`git reset`), o tempo de produtividade perdido pelo time debatendo com o ambiente motivou a criação deste projeto.

## 💡 A Solução: Trava Automatizada Nativa (Sem Docker)

Muitas empresas resolvem isso usando Docker. No entanto, para projetos que buscam performance máxima da máquina física ou que rodam em ambientes restritos, este boilerplate aborda a consistência de ambiente usando ferramentas nativas do próprio ecossistema **PHP (Composer)** e **Git**:

1. **Plataforma Travada (`composer.json`)**: Configurado com assinaturas de simulação estritas (`config.platform`). O Composer barra instantaneamente qualquer desenvolvedor que tente rodar um `composer update/install` se a máquina dele não atender aos requisitos.
2. **Artisan Checkup (`php artisan app:check`)**: Um comando de console personalizado que atua como o "médico do ambiente", escaneando a versão exata do PHP, a presença de arquivos `.env` cruciais e a integridade de rede com o banco de dados.
3. **Guardião do Commit (Git Hooks)**: Automatizado via scripts do Composer, um script de `pre-commit` é injetado na máquina do desenvolvedor. **O Git cancela o commit automaticamente** se o ambiente local possuir problemas críticos ou incompatibilidades de versão.

---
ENGLISH
---

## 🛠️ The Pain Point: A Real-World Scenario

I recently encountered a common scenario in the industry: while switching development of an internal system from a corporate computer to a personal machine, the local environment silently updated the global PHP version. When I performed a `git commit` and pushed the updates, the resulting mismatch in syntax and dependencies broke the local ecosystem for the rest of the team and corrupted the connection to the database.

Although Git allows for reverting commits (`git reset`), the loss of team productivity spent troubleshooting the environment served as the catalyst for creating this project.

## 💡 The Solution: Native, Automated Safeguards (No Docker Required)

Many companies address this by using Docker. However, for projects that require maximum performance from the physical hardware or those running in restricted environments, this boilerplate ensures environmental consistency using tools native to the **PHP (Composer)** and **Git** ecosystem:

1. **Locked Platform (`composer.json`)**: Configured with strict platform constraints (`config.platform`). Composer will immediately block any developer attempting to run `composer update` or `composer install` if their machine does not meet the specified requirements.
2. **Artisan Checkup (`php artisan app:check`)**: A custom console command that acts as an "environment health check," verifying the exact PHP version, the presence of essential `.env` files, and the integrity of the database connection.
3. **Commit Guardian (Git Hooks)**: Automated via Composer scripts, a `pre-commit` hook is injected into the developer's machine. **Git will automatically abort the commit** if the local environment contains critical issues or version incompatibilities.

---

## 🚀 Como Executar o Projeto

### 1. Clonar o repositório

```bash
git clone https://github.com
cd laravel-vue-sandbox
```

### 2. Instalar as Dependências (Ativa os Hooks Automaticamente)

```bash
composer install
npm install
```
*Durante o `composer install`, o script irá injetar a trava de commit na sua pasta oculta do Git `.git/hooks/pre-commit` de forma totalmente transparente.*

### 3. Rodar o checkup de Ambiente
```bash
php artisan app:check
```

### 4. Compilar os Assets do Vue.js
```bash
npm run dev
```

---
ENGLISH
---

## 🚀 How to Run the Project

### 1. Clone the repository

```bash
git clone https://github.com
cd laravel-vue-sandbox
```

### 2. Install dependencies (Automatically activates hooks)

```bash
composer install
npm install
```
*During `composer install`, the script will seamlessly inject a commit hook into your hidden `.git/hooks/pre-commit` file.*

### 3. Run the environment checkup
```bash
php artisan app:check
```

### 4. Compile Vue.js assets
```bash
npm run dev
```

---
## Demonstração do Git Hook em Ação

Se você tentar realizar um commit em um ambiente inválido ou corrompido, a sua experiência no terminal será parecida com esta:

```text
🛡️  [Git Hook] Iniciando validação de segurança do ambiente antes do commit...
🔍 Iniciando o checkup do ambiente de desenvolvimento...

👉 Verificando PHP local (Esperado: ~8.4)
   ❌ ERRO: Sua versão do PHP é 8.2.0. O projeto exige a versão 8.4.

🚨 [Git Hook] Commit cancelado! Seu ambiente possui problemas críticos.
Configure seu ambiente local antes de enviar o código para o repositório.
```

---
ENGLISH
---
## Git Hook in Action: A Demonstration

If you attempt to make a commit in an invalid or corrupted environment, your experience in the terminal will look something like this:

🛡️  [Git Hook] Initiating environment security validation before commit...
🔍 Starting development environment checkup...

👉 Checking local PHP (Expected: ~8.4)
   ❌ ERROR: Your PHP version is 8.2.0. The project requires version 8.4.

🚨 [Git Hook] Commit aborted! Your environment has critical issues.
Please configure your local environment before pushing code to the repository.
```

---

## Stack Tecnológica Dominada no Projeto
* **Backend:** Laravel 13 (Estrutura de comandos resumida)
* **Frontend:** Vue.js 3 (Integração reativa via Breeze)
* **Automação:** Shell Scripting / Git Hooks / Composer automation