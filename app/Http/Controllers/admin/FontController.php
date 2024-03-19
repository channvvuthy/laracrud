<?php

namespace App\Http\Controllers\admin;

use App\Models\Font;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FontController extends LaraCRUDController
{
    /**
     * @param Font $font
     */
    public function __construct(Font $font)
    {
        parent::__construct();

        $this->model = $font;
        $this->limit = 10;
        $this->export = false;

        $this->head = [
            array('field' => 'name', 'title' => 'Name'),
            array('field' => 'file', 'title' => 'File', 'type' => 'file'),
        ];


        $this->form = [
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'file', 'title' => 'File', 'type' => 'file', 'required' => true, 'validated' => 'required', 'accept' => '.ttf'),
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
        $this->data['form'] = $this->form;
        $this->init();
        return view('admin.add', ['data' => $this->data]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEdit($id): mixed
    {
        $this->data['form'] = $this->form;
        return parent::getEdit($id); // TODO: Change the autogenerated stub
    }
}
