<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminController extends LaraCRUDController
{

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct();

        $this->model = $user;
        $this->limit = 10;
        $this->export = true;
        $this->title = "User Management";

        $this->head = [
            array('field' => 'name', 'title' => 'Username'),
            array('field' => 'email', 'title' => 'Email'),
        ];

        $this->filter = [
            array('field' => 'name', 'type' => 'text', 'placeholder' => 'Search by name...'),
            array('field' => 'created_at', 'type' => 'picker', 'placeholder' => 'Start date'),
            array('field' => 'updated_at', 'type' => 'picker', 'placeholder' => 'End date'),
        ];

        $this->form = [
            array('field' => 'name', 'title' => 'Username', 'type' => 'text', 'required' => true, 'validated' => 'required|min:10'),
            array('field' => 'email', 'title' => 'Email', 'type' => 'text', 'required' => true, 'validated' => 'required|email'),
            array('field' => 'password', 'title' => 'Password', 'type' => 'password', 'required' => true, 'validated' => 'required'),
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
     * @return Factory|View|Application
     */
    public function getAdd(): Factory|View|Application
    {
        $this->title = "Add new user";
        $this->data['form'] = $this->form;
        $this->data['back'] = "user";
        $this->init();
        return view('admin.add', ['data' => $this->data]);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getEdit($id): mixed
    {
        $this->data['back'] = "user";
        $this->data['form'] = $this->form;
        return parent::getEdit($id); // TODO: Change the autogenerated stub
    }
}
