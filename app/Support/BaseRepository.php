<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\ForwardsCalls;

abstract class BaseRepository
{
    use ForwardsCalls;

    protected ?Model $entity;
    protected string $tableName;

    public function __construct()
    {
        $this->entity = $this->resolveEntity();
        $this->tableName = $this->entity->getTable();
    }

    abstract public function modelClass(): string;

    protected function resolveEntity(): Model
    {
        return app($this->modelClass());
    }

    public function findAll(): Collection
    {
        return $this->entity->all();
    }

    public function create(array|BaseDto $data): Model
    {
        if ($data instanceof BaseDto) {
            $data = $data->onlyFilled();
        }

        return $this->entity->create($data);
    }

    public function update(Model $model, array|BaseDto $attributes): Model
    {

        if ($attributes instanceof BaseDto) {
            $attributes = $attributes->onlyFilled();
        }

        $model->update($attributes);

        return $model;
    }

    public function delete($id): void
    {
        $user = $this->entity->findOrFail($id);
        $user->delete();
    }

    public function find($id): Model
    {
        return $this->entity->findOrFail($id);
    }

    public function __call($method, $arguments)
    {
        return $this->forwardCallTo($this->entity, $method, $arguments);
    }
}
