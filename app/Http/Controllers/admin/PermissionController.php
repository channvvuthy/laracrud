<?php

namespace App\Http\Controllers\admin;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends LaraCRUDController
{
    /**
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        parent::__construct();

        $this->model = $permission;
        $this->add = true;
        $this->title = "Permission List";
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
        $this->init();
        return view('admin.index', ['data' => $this->data]);
    }

    /**
     * @return Application|Factory|View
     */
    public function getAdd(): View|Factory|Application
    {
        $this->title = "Add new Permission";
        $this->data['back'] = "Permission";
        $this->data['form'] = $this->form;
        $this->init();
        return view('admin.add', ['data' => $this->data]);
    }
}
