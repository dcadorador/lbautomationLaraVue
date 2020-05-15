<?php

namespace App\Repositories\Eloquent;

use App\Helpers\OperatorConstants;
use App\Repositories\Interfaces\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    const PAGINATTION_LIMIT = 20;
    /**
     * @var MODEL
     */
    public $model;

    /**
     * @param array $query
     * @param bool $paginate
     * @return mixed
     */
    public function collection($query = [], $paginate = false)
    {
        if( !empty($query) ) {
            $this->findBy($query);
        }

        return $paginate ?
            $this->model->paginate(self::PAGINATTION_LIMIT) :
            $this->model->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id) {
        return $this->model->first($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data) {
        return $this->model->create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        $entity = $this->find($id);

        return $entity ?
            $entity->destroy :
            $entity;
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data) {
        $entity = $this->find($id);

        return $entity ?
            tap($entity)->update($data) :
            $entity;
    }

    /**
     * Queries model.
     *
     * $where = [
     *   'field_name' => [
     *      'value' => value
     *      'operator' => operator
     *      'where_type' => OperatorConstants::OPERATOR_WHERE or OperatorConstants::OPERATOR_OR_WHERE
     *   ],
     *   ... can add more ...
     * ]
     *
     * Notes:
     *   if 'operator' is LIKE, the value that would be passed
     *   should have '%' depending on what the application needs.
     *
     * Additional info:
     *   operator : optional
     *   where_type : optional
     *
     * @param array $where
     * @return model
     */
    public function findBy($where) {
        $model = $this->model;
        $model = $model->where(function ($query) use ($where) {
            foreach($where as $field => $value) {
                // get where type : orWhere() or where()
                $where_type = isset($value['where_type']) ? $value['where_type'] : OperatorConstants::OPERATOR_WHERE;
                // get the operator type
                $operator = isset($value['operator']) ? $value['operator'] : OperatorConstants::OPERATOR_AND;
                // get the value
                $val = isset($value['value']) ? $value['value'] : $value;

                // build query
                switch($operator) {
                    case OperatorConstants::OPERATOR_AND:
                    case OperatorConstants::OPERATOR_OR:
                        $query->$where_type($field, $val);
                        break;
                    case OperatorConstants::OPERATOR_LIKE:
                        $query->$where_type($field, 'LIKE', $val);
                        break;
                }
            }
        });

        return $model;
    }
}
