<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinceController extends LaraCRUDController
{
    /**
     * @param Province $country
     */
    public function __construct(Province $province)
    {
        parent::__construct();

        $this->model = $province;
        $this->limit = 10;
        $this->export = false;
        $this->title = "Province List";
        $this->select2 = true;

        $this->head = [
            array('field' => 'country_id', 'title' => 'Country', 'join' => 'countries', 'on' => 'country_id,id', 'column' => 'countries.name as country_name', 'dropdown' => 'country_id,id,name'),
            array('field' => 'name', 'title' => 'Name'),
            array('field' => 'description', 'title' => 'Description'),
        ];


        $this->form = [
            array('field' => 'country_id', 'title' => 'Country', 'type' => 'select2', 'required' => true, 'validated' => 'required', 'database' => 'countries,id,name', 'where' => ''),
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required|unique:countries'),
            array('field' => 'description', 'title' => 'Description', 'type' => 'text'),
        ];
    }


    /**
     * @return Application|Factory|View
     */
    public function getIndex(): View|Factory|Application
    {
        $this->result = $this->getJoin($this->model, $this->head);
        $this->init();
        return view('admin.index', ['data' => $this->data]);
    }

    /**
     * @return Factory|View|Application
     */
    public function getAdd(): Factory|View|Application
    {
        $this->title = "Add new " . $this->model->moduleName;
        $this->data['form'] = $this->form;
        $this->data['back'] = $this->model->moduleName;
        $this->addRelation($this->form);
        $this->init();
        return view('admin.add', ['data' => $this->data]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEdit($id): mixed
    {
        $this->find = $this->findJoin($this->model,$this->head,$id,$this->data);
        $this->data['form'] = $this->form;
        $this->title = 'Edit ' . $this->model->moduleName;
        $this->init();
        return view('admin.edit', ['data' => $this->data]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detail($id): mixed
    {
        $this->find = $this->findJoin($this->model, $this->head, $id);
        $this->title = 'Detail of ' . $this->model->moduleName;
        $this->data['detail'] = $this->model->detail;
        $this->init();
        return view('admin.detail', ['data' => $this->data]);


    }
}
