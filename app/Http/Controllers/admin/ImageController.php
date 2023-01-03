<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ImageController extends LaraCRUDController
{
    /**
     * @param Image $image
     */
    public function __construct(Image $image)
    {
        parent::__construct();

        $this->model = $image;
        $this->limit = 10;
        $this->export = false;
        $this->title = "Image Management";

        $this->head = [
            array('field' => 'title', 'title' => 'Title'),
            array('field' => 'image_url', 'title' => 'Image', 'type' => 'image', 'multiple' => true),
        ];

        $this->form = [
            array('field' => 'title', 'title' => 'Title', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'image_url', 'title' => 'Image', 'type' => 'file', 'required' => true, 'multiple' => true, 'validated' => 'required', 'accept' => 'image/png, image/gif, image/jpeg'),
        ];
    }

    /**
     * @return Application|Factory|View
     */
    public function getIndex(): View|Factory|Application
    {
        $this->result = $this->paginate();
        $this->init();
        return view('admincrud.index', ['data' => $this->data]);
    }

    /**
     * @return Factory|View|Application
     */
    public function getAdd(): Factory|View|Application
    {
        $this->title = "Add new " . $this->model->moduleName;
        $this->data['form'] = $this->form;
        $this->data['back'] = $this->model->moduleName;
        $this->init();
        return view('admincrud.add', ['data' => $this->data]);
    }
}
