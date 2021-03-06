<?php

namespace App\Repository\Models;

use App\Repository\Repository;

class TopUpRepository implements Repository 
{
    protected $model;
    public function __construct($model){
        $this->model = $model;
    }

    public function create($data){
       return $this->model->create($data);
    }

    public function edit($id, $data){
        $data = $this->find($id);
        return $this->model->update($data);
    }

    public function remove($id){
        return $this->model->destroy($id);
    }

    public function findOne($id) {
        return $this->model->findOrFail($id);
        
    }

    public function findAll(){
        return $this->model->all();
    }

    public function getModel(){
        return $this->model;
    }


    /** Traits */
    public function updatePaidStatus($id_topup){
        $topup = $this->model->find($id_topup);
        $topup->is_paid = true;
        $topup->save();

        return $topup;
    }

}