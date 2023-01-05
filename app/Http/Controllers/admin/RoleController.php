<?php

namespace App\Http\Controllers\admin;

use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Role;

class RoleController extends LaraCRUDController
{
    /**
     * @param Setting $role
     */
    public function __construct(Role $role)
    {
        parent::__construct();

        $this->model = $role;
        $this->add = true;
        $this->title = "Role List";
        $this->delete = true;

        $this->head = [
            array('field' => 'name', 'title' => 'Name'),
        ];

        $this->form = [
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
        ];
    }

    /**
     * @return Application|Factory|View
     */
    public function getIndex(): View|Factory|Application
    {
        $this->result = $this->paginate();
        $this->action_with = 380;
        $buttonAppend = [
            array('name' => 'Permission', 'action' => 'assign_permission', 'btn' => 'btn btn-info', 'icon' => 'fa fa-plus')
        ];
        $this->appendButton($this->data, $buttonAppend);
        $this->init();
        return view('admincrud.index', ['data' => $this->data]);
    }

    /**
     * @return Application|Factory|View
     */
    public function getAdd(): View|Factory|Application
    {
        $this->title = "Add new role";
        $this->data['back'] = "Role";
        $this->data['form'] = $this->form;
        $this->init();
        return view('admincrud.add', ['data' => $this->data]);
    }

}
