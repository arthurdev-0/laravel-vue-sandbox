<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckEnvironmentCommand extends Command
{
    /**
     * O nome e a assinatura do comando no terminal.
     */
    protected $signature = 'app:check';

    /**
     * A descrição do comando que aparece na listagem do artisan.
     */
    protected $description = 'Verifica se o ambiente local do desenvolvedor atende aos requisitos do projeto para evitar quebras.';

    /**
     * Versão do PHP esperada pelo projeto.
     */
    private string $requiredPhpVersion = '8.4';

    /**
     * Executa o comando no console.
     */
    public function handle(): int
    {
        $this->info('🔍 Iniciando o checkup do ambiente de desenvolvimento...');
        $this->newLine();

        $errors = 0;

        // 1. Verificar Versão do PHP
        $currentPhp = PHP_VERSION;
        $this->comment("👉 Verificando PHP local (Esperado: ~{$this->requiredPhpVersion})");
        
        // Verifica se a versão atual começa com a versão requerida (ex: 8.2.x)
        if (str_starts_with($currentPhp, $this->requiredPhpVersion)) {
            $this->info("   ✅ PHP correto: Versão {$currentPhp} instalada.");
        } else {
            $this->error("   ❌ ERRO: Sua versão do PHP é {$currentPhp}. O projeto exige a versão {$this->requiredPhpVersion}.");
            $this->warn("      Por favor, mude a versão do seu PHP local para evitar quebras no banco ou sintaxe.");
            $errors++;
        }
        $this->newLine();

        // 2. Verificar se o arquivo .env existe
        $this->comment('👉 Verificando arquivo de configuração (.env)');
        if (file_exists(base_path('.env'))) {
            $this->info('   ✅ Arquivo .env encontrado.');
        } else {
            $this->error('   ❌ ERRO: Arquivo .env não encontrado na raiz.');
            $this->warn('      Execute: cp .env.example .env e configure suas credenciais.');
            $errors++;
        }
        $this->newLine();

        // 3. Testar Conexão com o Banco de Dados
        $this->comment('👉 Testando conexão com o Banco de Dados...');
        try {
            \DB::connection()->getPdo();
            $this->info('   ✅ Conexão com o banco de dados estabelecida com sucesso.');
        } catch (\Exception $e) {
            $this->error('   ❌ ERRO: Não foi possível conectar ao banco de dados.');
            $this->warn('      Verifique suas credenciais no arquivo .env e se o seu serviço de banco está rodando.');
            // Não vamos somar erro aqui para o caso de um desenvolvedor novinho que acabou de clonar
        }
        $this->newLine();

        // Resultado Final
        if ($errors === 0) {
            $this->info('🎉 Parabéns! Seu ambiente está 100% idêntico e seguro para codar.');
            return Command::SUCCESS;
        }

        $this->error("🚨 Ambiente inválido! Foram encontrados {$errors} problema(s) crítico(s) acima.");
        return Command::FAILURE;
    }
}