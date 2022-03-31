<?php

namespace App\Contracts;

interface CitizenRepositoryInterface extends RepositoryInterface{

    public function findAll();
    public function findByCpf($cpf);
    public function updateByCpf($cpf, $data);
}