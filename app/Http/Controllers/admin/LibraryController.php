<?php

namespace App\Http\Controllers\admin;

use App\Models\Library;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;



class LibraryController extends LaraCRUDController
{
    /**
     * @param Library $library
     */
    public function __construct(Library $library)
    {
        parent::__construct();

        $this->model = $library;
        $this->limit = 10;
        $this->data['wysiwyg'] = true;
        $this->filter = [
            array('field' => 'q', 'type' => 'text', 'placeholder' => 'Search...')
        ];

        $this->head = [
            array('field' => 'thumbnail', 'title' => 'Thumbnail', 'type' => 'image'),
            array('field' => 'title_en', 'title' => 'Title (English)'),
            array('field' => 'description_en', 'title' => 'Description (English)'),
            array('field' => 'title_kh', 'title' => 'Title (Khmer)'),
            array('field' => 'description_kh', 'title' => 'Description (Khmer)'),
            array('field' => 'url', 'title' => 'URL'),

        ];

        $this->form = [
            array('field' => 'bible_study_id', 'title' => 'Bible Study', 'type' => 'select2', 'required' => true, 'validated' => 'required', 'database' => 'bible_studies,id,title_' . app()->getLocale(), 'where' => ''),
            array('field' => 'thumbnail', 'title' => 'Thumbnail', 'type' => 'file', 'required' => true, 'validated' => 'required', 'accept' => 'image/*'),
            array('field' => 'file', 'title' => 'File', 'type' => 'file', 'accept' => 'audio/mpeg, audio/mp3, video/mp4, application/pdf'),
            array('field' => 'url', 'title' => 'URL', 'type' => 'text'),
            array('field' => 'title_en', 'title' => 'Title (English)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'description_en', 'title' => 'Description (English)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'title_kh', 'title' => 'Title (Khmer)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'description_kh', 'title' => 'Description (Khmer)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
        ];
    }

    /**
     * @return Application|Factory|View
     */
    public function getIndex(): View|Factory|Application
    {
        $this->data['result'] = $this->search();
        $this->init();
        return view('admin.index', ['data' => $this->data]);
    }

    /**
     * Searches for records based on the provided search query.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator The paginated search results.
     */
    public function search()
    {
        $q = request()->get('q');
        $query = $this->model;

        if (!empty($q)) {
            $query = $query->where(function ($query) use ($q) {
                $query->where('title_en', 'like', '%' . $q . '%')
                    ->orWhere('title_kh', 'like', '%' . $q . '%');
            });
        }
        return $query->paginate($this->limit);
    }

    public function addDocForm()
    {
        $this->form = [
            array('field' => 'bible_study_id', 'title' => 'Bible Study', 'type' => 'select2', 'required' => true, 'validated' => 'required', 'database' => 'bible_studies,id,title_' . app()->getLocale(), 'where' => ''),
            array('field' => 'thumbnail', 'title' => 'Thumbnail', 'type' => 'file', 'required' => true, 'validated' => 'required', 'accept' => 'image/*'),
            array('field' => 'file', 'title' => 'File', 'type' => 'file', 'accept' => 'audio/mpeg, audio/mp3, video/mp4, application/pdf'),
            array('field' => 'url', 'title' => 'URL', 'type' => 'text'),
            array('field' => 'title_en', 'title' => 'Title (English)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'description_en', 'title' => 'Description (English)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'title_kh', 'title' => 'Title (Khmer)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'description_kh', 'title' => 'Description (Khmer)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
        ];
    }

    /**
     * @return Factory|View|Application
     */
    public function getAdd(): Factory|View|Application
    {
        // $this->addDocForm();
        $this->data['form'] = $this->form;
        $this->addRelation($this->form);

        return view('admin.library-add', ['data' => $this->data]);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getEdit($id): mixed
    {
        $this->data['form'] = $this->form;
        $this->data['form'][1] =  array('field' => 'thumbnail', 'title' => 'Thumbnail', 'type' => 'file', 'accept' => 'image/*');
        $this->addRelation($this->form);
        return parent::getEdit($id);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function detail($id): mixed
    {
        $this->data['find'] = $this->model->findOrFail($id);
        $this->data['title'] = 'Detail of ' . $this->model->moduleName;
        $this->data['back'] = $this->model->moduleName;
        $this->init();
        return view('admin.detail', ['data' => $this->data]);
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request): mixed
    {
        $this->form[1] =  array('field' => 'thumbnail', 'title' => 'Thumbnail', 'type' => 'file', 'accept' => 'image/*');
        return parent::update($request);
    }
}
