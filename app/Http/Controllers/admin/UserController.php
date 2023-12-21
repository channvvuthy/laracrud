<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class UserController extends LaraCRUDController
{
    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct();

        $this->model = $user;
        $this->add = true;
        $this->title = "User List";
        $this->delete = true;
        $this->model->moduleName = "User";
        $this->head = [
            array('field' => 'name', 'title' => 'Name'),
            array('field' => 'email', 'title' => 'Email'),
            array('field' => 'profile', 'title' => 'Photo', 'type' => 'image'),
            array('field' => 'phone', 'title' => 'Phone'),
            array('field' => 'gender', 'title' => 'Gender', 'type' => 'gender'),
            array('field' => 'date_of_birth', 'title' => 'Date of birth', 'view' => false),
            array('field' => 'place_of_birth', 'title' => 'Place of birth', 'view' => false),
            array('field' => 'living_address', 'title' => 'Address', 'view' => false),
            array('field' => 'created_at', 'title' => 'Register date', 'view' => false),
        ];

        $this->form = [
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'email', 'title' => 'Email', 'type' => 'email', 'required' => true, 'validated' => 'required|email|unique:users'),
            array('field' => 'password', 'title' => 'Password', 'type' => 'password', 'required' => true, 'validated' => 'required'),
            array('field' => 'profile', 'title' => 'Profile', 'type' => 'file', 'accept' => 'image/*'),
            array('field' => 'phone', 'title' => 'Phone', 'type' => 'number'),
            array('field' => 'gender', 'title' => 'Gender', 'type' => 'gender'),
            array('field' => 'date_of_birth', 'title' => 'Date of birth', 'type' => 'text'),
            array('field' => 'place_of_birth', 'title' => 'Place of birth', 'type' => 'text'),
            array('field' => 'living_address', 'title' => 'Address', 'type' => 'text'),
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
            array('name' => 'Role', 'action' => 'role/assign_role', 'btn' => 'btn btn-info', 'icon' => 'fa fa-plus', 'parent' => 'admin/user')
        ];
        $this->appendButton($this->data, $buttonAppend);
        $this->init();
        return view('admin.index', ['data' => $this->data]);
    }

    /**
     * @return Application|Factory|View
     */
    public function getAdd(): View|Factory|Application
    {
        $this->title = "Add new User";
        $this->data['back'] = "User";
        $this->data['form'] = $this->form;
        $this->init();
        return view('admin.add', ['data' => $this->data]);
    }
}
