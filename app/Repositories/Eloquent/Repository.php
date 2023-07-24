<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    public function __construct(protected Model $model) {

    }

    public function fill($data) {
        return $this->model->fill($data);
    }

    public function create($data = null)
    {
        if($data)
            return $this->model->fill($data)->save();

        return $this->model->save();
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


    public function like(string $column, string $query) {
        return $this->model->where($column, 'like', '%'.$query.'%')->get();
    }

    public function all()
    {
        return $this->model->all();
    }


}
