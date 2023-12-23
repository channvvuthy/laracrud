<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends LaraCRUDController
{
    /**
     * @param Brand $brand
     */
    public function __construct(Brand $brand)
    {

        $this->model = $brand;
        $this->limit = 10;

        $this->head = [
            array('field' => 'name', 'title' => 'Name'),
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'image'),
            array('field' => 'description', 'title' => 'Description'),
            array('field' => 'status', 'title' => 'Status'),
        ];

        $this->form = [
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'file', 'accept' => 'image/*', 'validated' => 'required'),
            array('field' => 'description', 'title' => 'Description', 'type' => 'text'),
            array('field' => 'status', 'title' => 'Status', 'type' => 'status'),

        ];
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getIndex(): mixed
    {
        $this->data['result'] = $this->paginate();
        return view('admin.index', ['data' => $this->data]);
    }
}