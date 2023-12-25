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

        $this->model = $menu;
        $this->limit = 10;
        $this->export = false;

        $this->head = [
            array('field' => 'icon', 'title' => 'Icon'),
            array('field' => 'name', 'title' => 'Name'),
            array('field' => 'action', 'title' => 'Path'),
            array('field' => 'parent_id', 'title' => 'Parent'),
            array('field' => 'order', 'title' => 'Order'),
        ];


        $this->form = [
            array('field' => 'parent_id', 'title' => 'Parent', 'type' => 'select2', 'database' => 'menus,id,name', 'where' => 'parent_id,NULL'),
            array('field' => 'icon', 'title' => 'Icon', 'type' => 'text', 'required' => true, 'validated' => 'required|min:5'),
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'action', 'title' => 'Path', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'order', 'title' => 'Order', 'type' => 'number', 'required' => true, 'validated' => 'required'),
        ];

        parent::__construct();

    }

    /**
     * @return Application|Factory|View
     */
    public function getIndex(): View|Factory|Application
    {
        $this->data['result'] = $this->paginate();
        return view('admin.index', ['data' => $this->data]);
    }

    /**
     * @return Factory|View|Application
     */
    public function getAdd(): Factory|View|Application
    {

        $this->data['form'] = $this->form;
        $this->addRelation($this->form);
        return view('admin.add', ['data' => $this->data]);
    }

    /**
     * Retrieves the edit view for a specific record.
     *
     * @param mixed $id The ID of the record to be edited.
     * @return mixed The rendered edit view with the record's data.
     */
    public function getEdit($id): mixed
    {
        $this->data['find'] = $this->findJoin($this->model, $this->head, $id, $this->data);

        // Reset the 'where' condition in the first form element
        $this->form[0]['where'] = '';

        // Set form data and add relations
        $this->data['form'] = $this->form;
        $this->addRelation($this->data['form']);

        // Return the view
        return view('admin.edit', ['data' => $this->data]);
    }

}
