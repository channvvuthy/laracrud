<?php

namespace App\Http\Controllers\admin;

use App\Models\Offering;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class OfferingController extends LaraCRUDController
{
    /**
     * @param Offering $offering
     */
    public function __construct(Offering $offering)
    {
        parent::__construct();

        $this->model = $offering;
        $this->limit = 10;
        $this->export = false;
        $this->data['wysiwyg'] = true;

        $this->head = [
            array('field' => 'title_en', 'title' => 'Title (English)'),
            array('field' => 'description_en', 'title' => 'Description (English)'),
            array('field' => 'title_kh', 'title' => 'Title (Khmer)'),
            array('field' => 'description_kh', 'title' => 'Description (Khmer)'),
            array('field' => 'way_to_give_en', 'title' => 'Way to give (English)'),
            array('field' => 'way_to_give_kh', 'title' => 'Way to give (Khmer)'),
            array('field' => 'in_cash_en', 'title' => 'In cash (English)'),
            array('field' => 'in_cash_kh', 'title' => 'In cash (Khmer)'),
        ];


        $this->form = [
            array('field' => 'title_en', 'title' => 'Title (English)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'description_en', 'title' => 'Description (English)', 'type' => 'wysiwyg', 'required' => true, 'validated' => 'required'),
            array('field' => 'title_kh', 'title' => 'Title (Khmer)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'description_kh', 'title' => 'Description (Khmer)', 'type' => 'wysiwyg', 'required' => true, 'validated' => 'required'),
            array('field' => 'way_to_give_en', 'title' => 'Way to give (English)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'way_to_give_kh', 'title' => 'Way to give (Khmer)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'in_cash_title_en', 'title' => 'In Cash Title (English)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'in_cash_description_en', 'title' => 'Description (English)', 'type' => 'wysiwyg', 'required' => true, 'validated' => 'required'),
            array('field' => 'in_cash_title_kh', 'title' => 'In Cash Title (Khmer)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'in_cash_description_kh', 'title' => 'Description (English)', 'type' => 'wysiwyg', 'required' => true, 'validated' => 'required'),
            array('field' => 'international_title_en', 'title' => 'International Title (English)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'international_description_en', 'title' => 'Description (English)', 'type' => 'wysiwyg', 'required' => true, 'validated' => 'required'),
            array('field' => 'international_title_kh', 'title' => 'International Title (Khmer)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'international_description_kh', 'title' => 'Description (Khmer)', 'type' => 'wysiwyg', 'required' => true, 'validated' => 'required'),
            array('field' => 'via_account_title_en', 'title' => 'Via Account Title (English)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'via_account_title_kh', 'title' => 'Via Account Title (Khmer)', 'type' => 'text', 'required' => true, 'validated' => 'required'),


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
        $this->title = "Add new offering";
        $this->data['form'] = $this->form;
        $this->data['back'] = $this->model->moduleName;
        return view('admin.add', ['data' => $this->data]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEdit($id): mixed
    {
        $this->data['back'] = $this->model->moduleName;
        $this->data['form'] = $this->form;
        return parent::getEdit($id); // TODO: Change the autogenerated stub
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
}
