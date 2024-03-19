<?php

namespace App\Http\Controllers\admin;

use App\Models\Social;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SocialController extends LaraCRUDController
{
    public function __construct(Social $social)
    {
        $this->model = $social;

        $this->head = [
            array('field' => 'name', 'title' => 'Name'),
            array('field' => 'link', 'title' => 'Link'),
            array('field' => 'icon', 'title' => 'Icon', 'type' => 'image'),
        ];

        $this->form = [
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'link', 'title' => 'Link', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'icon', 'title' => 'Icon', 'type' => 'file', 'required' => true, 'validated' => 'required', 'accept' => 'image/*'),
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

}
