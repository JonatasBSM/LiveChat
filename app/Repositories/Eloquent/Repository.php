<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    public function __construct(protected Model $model) {

    }

    public function create()
    {
        $this->model->save();
    }

    public function fill($data)
    {
        return $this->model->fill($data)->save();
    }

    public function update($primaryKey, $data)
    {
        return $this->find($primaryKey)->update($data);
    }

    public function destroy($primaryKey)
    {
        return $this->find($primaryKey)->destroy();
    }

    public function find($primaryKey)
    {
        return $this->model->find($primaryKey);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function thenCreate($primaryKey,array $dataForUpdate, array $dataForSave) {

        $instance = $this->find($primaryKey);

        if($instance)
            return $instance->update($dataForUpdate);

        return $this->create($dataForSave);
    }

    public function findByName(string $name)
    {
        $row = $this->model->whereName($name)->first();
        return $row;
    }

    public function getColumn(string $name) {
        return $this->model->pluck($name);
    }
}
