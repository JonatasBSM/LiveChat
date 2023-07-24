<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function all();

    public function find($primaryKey);

    public function fill($data);

    public function create();

    public function update($primaryKey, $data);

    public function destroy($primaryKey);

    public function like(string $column, string $query);

}
