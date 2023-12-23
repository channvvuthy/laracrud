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

        $this->model = $product;
        $this->limit = 10;
        $this->export = false;
        $this->select2 = true;

        $this->head = [
            array('field' => 'code', 'title' => 'Code'),
            array('field' => 'name', 'title' => 'Name'),
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'image'),
            array('field' => 'category_name', 'title' => 'Category', 'join' => 'categories', 'on' => 'category_id,id', 'column' => 'categories.name as category_name', 'dropdown' => 'category_id,id,name'),
            array('field' => 'brand_name', 'title' => 'Branch', 'join' => 'brands', 'on' => 'brand_id,id', 'column' => 'brands.name as brand_name', 'dropdown' => 'brand_id,id,name'),
            array('field' => 'unit_name', 'title' => 'Unit', 'join' => 'units', 'on' => 'unit_id,id', 'column' => 'units.name as unit_name', 'dropdown' => 'unit_id,id,name'),
            array('field' => 'purchase_price', 'title' => 'Purchase Price'),
            array('field' => 'sale_price', 'title' => 'Sale Price'),
            array('field' => 'quantity', 'title' => 'Quantity'),
        ];


        $this->form = [
            array('field' => 'code', 'title' => 'Code', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'file', 'accept' => 'image/*', 'validated' => 'required'),
            array('field' => 'category_id', 'title' => 'Category', 'type' => 'select2', 'database' => 'categories,id,name', 'where' => ''),
            array('field' => 'brand_id', 'title' => 'Branch', 'type' => 'select2', 'database' => 'brands,id,name', 'where' => ''),
            array('field' => 'unit_id', 'title' => 'Unit', 'type' => 'select2', 'database' => 'units,id,name', 'where' => ''),
            array('field' => 'purchase_price', 'title' => 'Purchase Price', 'type' => 'number', 'required' => true, 'validated' => 'required'),
            array('field' => 'sale_price', 'title' => 'Sale Price', 'type' => 'number', 'required' => true, 'validated' => 'required'),
            array('field' => 'quantity', 'title' => 'Quantity', 'type' => 'number'),
            array('field' => 'description', 'title' => 'Description', 'type' => 'textarea'),

        ];

        parent::__construct();
    }

    /**
     * @return Application|Factory|View
     */
    public function getIndex(): View|Factory|Application
    {
        $this->data['result'] = $this->getJoin($this->model, $this->head);
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

    /**
     * Retrieves the detail of an item by its ID.
     *
     * @param mixed $id The ID of the item.
     * @return mixed The rendered view with the item detail.
     */
    public function detail($id): mixed
    {
        $this->data['find'] = $this->model->findOrFail($id);

        return view('admin.detail', ['data' => $this->data]);
    }

}
