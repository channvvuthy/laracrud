<?php

namespace App\Http\Controllers\admin;


use App\Models\Menu;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MenuController extends LaraCRUDController
{

    /**
     * @param Menu $menu
     */
    public function __construct(Menu $menu)
    {
        parent::__construct();

        $this->model = $menu;
        $this->limit = 10;
        $this->export = false;

        $this->head = [
            array('field' => 'icon', 'title' => 'Icon'),
            array('field' => 'name', 'title' => 'Name'),
            array('field' => 'action', 'title' => 'Path'),
            array('field' => 'order', 'title' => 'Order'),
        ];


        $this->form = [
            array('field' => 'icon', 'title' => 'Icon', 'type' => 'text', 'required' => true, 'validated' => 'required|min:5'),
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'action', 'title' => 'Path', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'order', 'title' => 'Order', 'type' => 'number'),
        ];
    }

    /**
     * @return Application|Factory|View
     */
    public function getIndex(): View|Factory|Application
    {
        $this->title = $this->model->moduleName. " List";
        $this->result = $this->paginate();
        $this->init();
        return view('admincrud.index', ['data' => $this->data]);
    }

    /**
     * @return Factory|View|Application
     */
    public function getAdd(): Factory|View|Application
    {

        $this->title = "Add new ". $this->model->moduleName;
        $this->data['form'] = $this->form;
        $this->data['back'] = $this->model->moduleName;
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
