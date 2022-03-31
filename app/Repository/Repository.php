<?php

namespace App\Repository;

abstract class Repository{

    public function get(){
        return $this->model->get();
    }

    public function find($id){
        return $this->model->find($id);
    }

    public function update($id, $data){
        return $this->model->update($id, $data);
    }

    public function delete($id){
        return $this->model::where('id', $id)->delete();
    }

    public function create($data){
        return $this->model->create($data);
    }
}