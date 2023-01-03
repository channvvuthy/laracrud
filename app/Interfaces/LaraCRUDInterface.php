<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface LaraCRUDInterface
{
    /**
     * @return mixed
     */
    public function getIndex(): mixed;

    /**
     * @return mixed
     */
    public function getAdd(): mixed;

    /**
     * @param Request $request
     * @return mixed
     */
    public function postAdd(Request $request): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function getEdit($id): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed;

    /**
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function detail($id): mixed;

    /**
     * @param $model
     * @param $header
     * @return mixed
     */
    public function getJoin($model, $header): mixed;
}
