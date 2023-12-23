<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProductController extends LaraCRUDController
{
    /**
     * @param Product $product;
     */
    public function __construct(Product $product)
    {
        parent::__construct();

        $this->model = $product;
        $this->limit = 10;
        $this->export = false;
        $this->select2 = true;

        $this->head = [
            array('field' => 'code', 'title' => 'Code'),
            array('field' => 'name', 'title' => 'Name'),
            array('field' => 'photo', 'title' => 'photo'),
            array('field' => 'category_id', 'title' => 'Category', 'join' => 'categories', 'on' => 'category_id,id', 'column' => 'categories.title as category_title', 'dropdown' => 'category_id,id,title'),
            array('field' => 'brand_id', 'title' => 'Branch'),
            array('field' => 'unit_id', 'title' => 'Unit'),
            array('field' => 'purchase_price', 'title' => 'Purchase Price'),
            array('field' => 'sale_price', 'title' => 'Sale Price'),
            array('field' => 'quantity', 'title' => 'Quantity'),
        ];


        $this->form = [
            array('field' => 'code', 'title' => 'Code', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'file', 'accept' => 'image/*', 'validated' => 'required'),
            array('field' => 'category_id', 'title' => 'Category', 'type' => 'select2', 'required' => true, 'validated' => 'required', 'database' => 'categories,id,name', 'where' => ''),
            array('field' => 'brand_id', 'title' => 'Branch', 'type' => 'select2', 'required' => true, 'validated' => 'required', 'database' => 'brands,id,name', 'where' => ''),
            array('field' => 'unit_id', 'title' => 'Unit', 'type' => 'select2', 'required' => true, 'validated' => 'required', 'database' => 'units,id,name', 'where' => ''),
            array('field' => 'purchase_price', 'title' => 'Purchase Price', 'type' => 'number'),
            array('field' => 'sale_price', 'title' => 'Sale Price', 'type' => 'number'),
            array('field' => 'quantity', 'title' => 'Quantity', 'type' => 'number'),
            array('field' => 'description', 'title' => 'Description', 'type' => 'textarea'),

        ];
    }

    /**
     * @return Application|Factory|View
     */
    public function getIndex(): View|Factory|Application
    {
        $this->result = $this->paginate();
        return view('admin.index', ['data' => $this->data]);
    }

    /**
     * @return View|Factory|Application
     */
    public function getAdd(): View|Factory|Application
    {
        $this->data['form'] = $this->form;
        $this->addRelation($this->form);

        return view('admin.add', ['data' => $this->data]);
    }

}
