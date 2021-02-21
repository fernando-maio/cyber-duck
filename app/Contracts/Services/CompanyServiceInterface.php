<?php

namespace App\Contracts\Services;

interface CompanyServiceInterface
{
    public function list();

    public function create(array $data);
    
    public function getById(int $id);
    
    public function update(int $id, array $data);
    
    public function delete(int $id);
}