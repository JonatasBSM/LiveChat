<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function all();

    public function find($primaryKey);

    public function create($data);

    public function update($primaryKey, $data);

    public function destroy($primaryKey);

    public function thenCreate($primaryKey,array $dataForUpdate, array $dataForSave);

    public function findByName(string $name);

    public function getColumn(string $name);
}
