<?php

namespace App\Http\Controllers\admin;

use App\Models\Course;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;


class CourseController extends LaraCRUDController
{
    /**
     * @param Course $course
     */
    public function __construct(Course $course)
    {
        parent::__construct();

        $this->model = $course;
        $this->limit = 10;
        $this->title = "Course List";

        $this->head = [
            array('field' => 'icon', 'title' => 'Icon', 'type' => 'image'),
            array('field' => 'name', 'title' => 'Course Name'),
            array('field' => 'description', 'title' => 'Description'),
        ];

        $this->form = [
            array('field' => 'icon', 'title' => 'Icon', 'type' => 'file', 'required' => true, 'validated' => 'required', 'accept' => 'image/*'),
            array('field' => 'name', 'title' => 'Course Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'description', 'title' => 'Description', 'type' => 'text', 'required' => true, 'validated' => 'required'),
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
        $this->title = "Add new ".$this->model->moduleName;
        $this->data['form'] = $this->form;
        $this->data['back'] = $this->model->moduleName;
        $this->init();
        return view('admincrud.add', ['data' => $this->data]);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getEdit($id): mixed
    {
        $this->data['back'] = "user";
        $this->data['form'] = $this->form;
        return parent::getEdit($id); // TODO: Change the autogenerated stub
    }


    /**
     * @param $id
     * @return mixed
     */
    public function detail($id): mixed
    {
        $this->find = $this->model->findOrFail($id);
        $this->title = 'Detail of ' . $this->model->moduleName;
        $this->data['back'] = $this->model->moduleName;
        $this->init();
        return view('admincrud.detail', ['data' => $this->data]);
    }
}
