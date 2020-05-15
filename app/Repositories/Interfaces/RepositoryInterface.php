<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{

    /**
     * @param $query
     * @return mixed
     */
    public function collection($query = []);

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param $data
     * @return mixed
     */
    public function store($data);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data);

}
