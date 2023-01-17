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
        parent::__construct();
        $this->model = $category;
        $this->limit = 10;
        $this->title = "Category List";

        $this->head = [
            array('field' => 'name', 'title' => 'Name'),
            array('field' => 'photo', 'title' => 'Photo'),
            array('field' => 'description', 'title' => 'Description'),
            array('field' => 'status', 'title' => 'Status'),
        ];

        $this->form = [
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required|min:10'),
        ];
    }

    /**
     * @return mixed
     */
    public function getIndex(): mixed
    {
        $this->result = $this->paginate();
        $this->init();
        return view('admincrud.index', ['data' => $this->data]);
    }

    /**
     * @return View|Factory|Application
     */
    public function getAdd(): View|Factory|Application
    {
        $this->title = "Add new Category";
        $this->data['form'] = $this->form;
        $this->data['back'] = "Category";
        $this->init();
        return view('admincrud.add', ['data' => $this->data]);
    }
}
