<?php

namespace App\Http\Controllers\admin;

use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
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
        $this->model->moduleName = "Role";
    }

    /**
     * @return Application|Factory|View
     */
    public function getIndex(): View|Factory|Application
    {
        $this->result = $this->paginate();
        $this->action_with = 380;
        $buttonAppend = [
            array('name' => 'Permission', 'action' => 'role/assign_permission', 'btn' => 'btn btn-info', 'icon' => 'fa fa-plus', 'parent' => 'admin/role')
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

    /**
     * @param $id
     * @return Factory|View|Application
     */
    public function assignPermission($id): View|Factory|Application
    {
        $this->find = $this->findbyId($id);
        $this->title = "Assign Permission to Role : " . $this->find->name;
        $this->data['permissions'] = Permission::all();
        $this->data['find'] = $this->find;
        $this->init();
        return view('admincrud.role.assign_permission', ['data' => $this->data]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function postAssignPermission(Request $request): JsonResponse
    {
        $role = Role::findById($request->role);
        $permission = Permission::findById($request->permission);
        $role->hasPermissionTo($request->name) ? $role->revokePermissionTo($request->name) : $role->givePermissionTo($request->name);

        return response()->json(array('msg' => 'success'), 200);
    }

}
