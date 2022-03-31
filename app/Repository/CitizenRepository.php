<?php

namespace App\Repository;

use App\Contracts\CitizenRepositoryInterface;
use App\Models\Citizen as CitizenModel;

class CitizenRepository extends Repository implements CitizenRepositoryInterface{

    protected $model;

    public function __construct(CitizenModel $model){
        $this->model = $model;
    }

    public function findAll(){
        return $this->model::orderBy('nome', 'ASC')->get();
    }

    public function findByCpf($cpf){
        return $this->model::where('cpf', $cpf)->get();
    }

    public function updateByCpf($cpf, $data){
        return $this->model::where('cpf', $cpf)->update($data);
    }

}