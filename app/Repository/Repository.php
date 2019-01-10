<?php

namespace App\Repository;

interface Repository {
    public function create($data);
    public function edit($id, $data); 
    public function remove($id);
    public function findOne($id); // find by Id
    public function findAll();
    public function getModel();
}