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
        $this->title = trans('common.Category List');

        $this->head = [
            array('field' => 'title', 'title' => 'Name'),
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'image'),
            array('field' => 'description', 'title' => 'Description'),
            array('field' => 'status', 'title' => 'Status'),
        ];

        $this->form = [
            array('field' => 'title', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'file', 'accept' => 'image/*', 'validated' => 'required'),
            array('field' => 'description', 'title' => 'Description', 'type' => 'text'),
            array('field' => 'status', 'title' => 'Status', 'type' => 'status'),

        ];
        parent::__construct();
    }
}
