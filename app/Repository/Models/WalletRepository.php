<?php

namespace App\Repository\Models;

use App\Repository\Repository;
use Illuminate\Support\Facades\Auth;

class WalletRepository implements Repository 
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

    public function findByUser($id_user){
        return $this->model->where(['id_user' => $id_user])->first();
    }

    /** Traits */
    public function updateBalance($topup){
        $user = Auth::user();
        $wallet = $this->findByUser($user->id);
        
        $wallet->balance = $this->_updateBalance($wallet->balance, $topup);
        $wallet->save();
        return $wallet;
    }

    private function _updateBalance($currentBalance, $topup){
        return intval($currentBalance) + intval($topup);
    }
}