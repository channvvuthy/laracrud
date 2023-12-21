<?php

namespace App\Http\Controllers\admin;

use App\Models\Slider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SliderController extends LaraCRUDController
{
    public function __construct(Slider $slider)
    {
        $this->model = $slider;
        $this->title = "Slider";

        $this->head = [
            array('field' => 'title', 'title' => 'Title'),
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'image'),
            array('field' => 'description', 'title' => 'Description'),
            array('field' => 'action', 'title' => 'Path'),
            array('field' => 'status', 'title' => 'Status', 'type' => 'status'),
        ];

        $this->form = [
            array('field' => 'title', 'title' => 'Title', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'file', 'required' => true, 'validated' => 'required', 'accept' => 'image/*'),
            array('field' => 'action', 'title' => 'Action', 'type' => 'text'),
            array('field' => 'description', 'title' => 'Description', 'type' => 'text'),
            array('field' => 'status', 'title' => 'Status', 'type' => 'status'),
        ];
    }

    /**
     * @return Application|Factory|View
     */
    public function getIndex(): View|Factory|Application
    {
        $this->result = $this->paginate();
        $this->title = "Slider list";
        $this->init();
        return view('admin.index', ['data' => $this->data]);
    }

    /**
     * @return Factory|View|Application
     */
    public function getAdd(): Factory|View|Application
    {
        $this->title = "Add new Slider";
        $this->data['form'] = $this->form;
        $this->data['back'] = "Slider";
        $this->init();
        return view('admin.add', ['data' => $this->data]);
    }

}
