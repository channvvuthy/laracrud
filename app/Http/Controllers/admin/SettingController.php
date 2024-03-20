<?php

namespace App\Http\Controllers\admin;

use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Artisan;

class SettingController extends LaraCRUDController
{
    /**
     * @param Setting $setting
     */
    public function __construct(Setting $setting)
    {
        parent::__construct();

        $this->model = $setting;
        $this->add = true;
        $this->delete = false;


        $this->head = [
            array('field' => 'default_font', 'title' => 'Default Font'),
            array('field' => 'navbar_font', 'title' => 'Navbar Font'),
            array('field' => 'title_font', 'title' => 'Title Font'),
            array('field' => 'paragraph_font', 'title' => 'Paragraph Font'),
            array('field' => 'paragraph_line_height', 'title' => 'Paragraph Line Height'),
            array('field' => 'logo', 'title' => 'Logo', 'type' => 'image'),

        ];

        $this->form = [
            array('field' => 'default_font', 'title' => 'Default Font', 'type' => 'select2', 'required' => true, 'validated' => 'required', 'database' => 'fonts,name,name', 'where' => ''),
            array('field' => 'navbar_font', 'title' => 'Navbar Font', 'type' => 'select2', 'required' => true, 'validated' => 'required', 'database' => 'fonts,name,name', 'where' => ''),
            array('field' => 'title_font', 'title' => 'Title Font', 'type' => 'select2', 'required' => true, 'validated' => 'required', 'database' => 'fonts,name,name', 'where' => ''),
            array('field' => 'paragraph_font', 'title' => 'Paragraph Font', 'type' => 'select2', 'required' => true, 'validated' => 'required', 'database' => 'fonts,name,name', 'where' => ''),
        array('field' => 'paragraph_line_height', 'title' => 'Paragraph Line Height', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'logo', 'title' => 'Logo', 'type' => 'file', 'accept' => 'image/*'),

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
     * Retrieves the edit form for a specific record.
     *
     * @param mixed $id The ID of the record to edit.
     * @return mixed The view for editing the record.
     */
    public function getEdit($id): mixed
    {
        $this->data['find'] = $this->model->findOrFail($id);
        $this->data['form'] = $this->form;
        $this->addRelation($this->form);

        return view('admin.setting-edit', ['data' => $this->data]);
    }

    public function clearCache()
    {
        // Clear application cache
        Artisan::call('cache:clear');

        // Optionally, you can also clear configuration cache
        Artisan::call('config:clear');

        // Optionally, you can clear route cache
        Artisan::call('route:clear');

        // Optionally, you can clear view cache
        Artisan::call('view:clear');

        return redirect()->back();
    }

    /**
     * @return Factory|View|Application
     */
    public function getAdd(): Factory|View|Application
    {
        $this->data['form'] = $this->form;
        $this->addRelation($this->form);
        return view('admin.setting-add', ['data' => $this->data]);
    }
    
}
