<?php

namespace App\Http\Controllers\admin;

use App\Models\Bank;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class BankController extends LaraCRUDController
{
    /**
     * @param Bank $bank
     */
    public function __construct(Bank $bank)
    {
        parent::__construct();

        $this->model = $bank;
        $this->limit = 10;
        $this->export = false;
        $this->data['wysiwyg'] = true;

        $this->head = [
            array('field' => 'icon', 'title' => 'Icon', 'type' => 'image'),
            array('field' => 'qr_code', 'title' => 'QR Code', 'type' => 'image'),
            array('field' => 'name', 'title' => 'Name'),
            array('field' => 'number', 'title' => 'Number'),
            array('field' => 'account_name', 'title' => 'Account Name'),
        ];


        $this->form = [
            array('field' => 'icon', 'title' => 'Icon', 'type' => 'file', 'required' => true, 'validated' => 'required', 'accept' => 'image/*'),
            array('field' => 'qr_code', 'title' => 'QR Code', 'type' => 'file', 'required' => true, 'validated' => 'required', 'accept' => 'image/*'),
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required',),
            array('field' => 'number', 'title' => 'Number', 'type' => 'text', 'required' => true, 'validated' => 'required',),
            array('field' => 'account_name', 'title' => 'Account Name', 'type' => 'text', 'required' => true, 'validated' => 'required',),
        ];
    }


    /**
     * @return Application|Factory|View
     */
    public function getIndex(): View|Factory|Application
    {
        $this->data['result'] = $this->paginate();
        $this->init();
        return view('admin.index', ['data' => $this->data]);
    }

    /**
     * @return Factory|View|Application
     */
    public function getAdd(): Factory|View|Application
    {
        $this->title = "Add new bank";
        $this->data['form'] = $this->form;
        $this->data['back'] = $this->model->moduleName;
        return view('admin.add', ['data' => $this->data]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEdit($id): mixed
    {
        $this->data['back'] = $this->model->moduleName;
        $this->form[0] = array('field' => 'icon', 'title' => 'Icon', 'type' => 'file', 'accept' => 'image/*');
        $this->form[1] = array('field' => 'qr_code', 'title' => 'QR Code', 'type' => 'file', 'accept' => 'image/*');
        $this->data['form'] = $this->form;
        return parent::getEdit($id); // TODO: Change the autogenerated stub
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detail($id): mixed
    {
        $this->data['find'] = $this->model->findOrFail($id);
        $this->data['title'] = 'Detail of ' . $this->model->moduleName;
        $this->data['back'] = $this->model->moduleName;
        $this->init();
        return view('admin.detail', ['data' => $this->data]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request): mixed
    {
        $this->form[0] = array('field' => 'icon', 'title' => 'Icon', 'type' => 'file', 'accept' => 'image/*');
        $this->form[1] = array('field' => 'qr_code', 'title' => 'QR Code', 'type' => 'file', 'accept' => 'image/*');
        return parent::update($request);
    }
}
