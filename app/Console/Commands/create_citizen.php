<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Citizen;

class create_citizen extends Command
{
    protected $repository;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:citizen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Citizen';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $nome = $this->ask('Nome:');
        $sobrenome = $this->ask('Sobrenome:');
        $cpf = $this->ask('Cpf:');
        $email = $this->ask('Email:');
        $celular = $this->ask('Celular:');
        $cep = $this->ask('Cep:');

        try{
            $data = [
                'nome' => $nome,
                'sobrenome' => $sobrenome,
                'cpf' => $cpf,
                'email' => $email,
                'celular' => $celular,
                'cep' => $cep,
            ];
            $endereco = json_decode(file_get_contents("https://viacep.com.br/ws/{$data['cep']}/json/"));

            $citizen = Citizen::create(
                array_merge($data, ['logradouro' => $endereco->logradouro, 'bairro' => $endereco->bairro, 'cidade' => $endereco->localidade, 'uf' => $endereco->uf])
            );

            return ['message' => 'Successfully create', 'data' => $citizen];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
