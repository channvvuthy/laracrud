<?php

namespace App\Http\Controllers\admin;

use App\Models\Country;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CountryController extends LaraCRUDController
{
    /**
     * @param Country $country
     */
    public function __construct(Country $country)
    {
        parent::__construct();

        $this->model = $country;
        $this->limit = 10;
        $this->export = false;
        $this->title = "Country List";

        $this->head = [
            array('field' => 'name', 'title' => 'Name'),
            array('field' => 'description', 'title' => 'Description'),
        ];


        $this->form = [
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'description', 'title' => 'Description', 'type' => 'wysiwyg'),
        ];
    }


    /**
     * @return Application|Factory|View
     */
    public function getIndex(): View|Factory|Application
    {
        $this->result = $this->paginate();
        $this->init();
        return view('admincrud.index', ['data' => $this->data]);
    }

    /**
     * @return Factory|View|Application
     */
    public function getAdd(): Factory|View|Application
    {
        $this->title = "Add new country";
        $this->data['form'] = $this->form;
        $this->data['back'] = "user";
        $this->init();
        return view('admincrud.add', ['data' => $this->data]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEdit($id): mixed
    {
        $this->data['back'] = $this->model->moduleName;
        $this->data['form'] = $this->form;
        return parent::getEdit($id); // TODO: Change the autogenerated stub
    }
}
