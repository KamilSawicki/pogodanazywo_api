<?php


namespace App\Repository;


use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    private Model $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function all() : Collection {
        return $this->model->all();
    }

    /**
     * @throws Exception
     */
    public function find(string|int $id) : Model {
        $entity = $this->model->find($id);
        if (is_null($entity)) {
            throw new Exception(__('entity_exception.not_found'));
        }
        else {
            return $entity;
        }
    }

    public function store(array $attributes) : Model {
        $entity = $this->model;
        $entity->fill($attributes);
        $entity->save();
        return $entity;
    }

    /**
     * @throws Exception
     */
    public function update(array $attributes, string|int $id) : Model {
        $entity = $this->find($id);
        if (is_null($entity)) {
            throw new Exception(__('entity_exception.not_found'));
        }
        else {
            $entity->fill($attributes);
            $entity->save();
            return $entity;
        }
    }

    /**
     * @throws Exception
     */
    public function delete(string|int $id) : void {
        $entity = $this->find($id);
        if (is_null($entity)) {
            throw new Exception(__('entity_exception.not_found'));
        }
        else {
            $entity->delete();
        }
    }
}
