<?php

namespace App\Repository\Models;

use Exception;
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
    public function topup($topup){
        $user = Auth::user();
        $wallet = $this->findByUser($user->id);
        
        $wallet->balance = $this->_topup($wallet->balance, $topup);
        $wallet->save();
        return $wallet;
    }

    public function _topup($currentBalance, $topup){
        if($this->isNegativeTopUp($topup)) {
            throw new Exception('Top Up Cannot Negative');
        }
        return intval($currentBalance) + intval($topup);
    }

    public function isNegativeTopUp($topup){
        return $topup < 0;
    }
}