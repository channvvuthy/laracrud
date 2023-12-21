<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CategoryController extends LaraCRUDController
{

    /**
     * @param Category $category
     */
    public function __construct(Category $category)
    {

        $this->model = $category;
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

    /**
     * @return mixed
     */
    public function getIndex(): mixed
    {
        $this->result = $this->paginate();
        return view('admin.index', ['data' => $this->data]);
    }

    /**
     * @return View|Factory|Application
     */
    public function getAdd(): View|Factory|Application
    {
        $this->data['title'] = trans('common.Add new Category');
        $this->data['form'] = $this->form;
        $this->data['back'] = "Category";
        return view('admin.add', ['data' => $this->data]);
    }
}
