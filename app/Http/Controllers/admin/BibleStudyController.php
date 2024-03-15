<?php

namespace App\Http\Controllers\admin;

use App\Models\BibleStudy;
use Helper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Library;

class BibleStudyController extends LaraCRUDController
{
    /**
     * @param BibleStudy $bibleStudy
     */
    public function __construct(BibleStudy $bibleStudy)
    {
        parent::__construct();

        $this->model = $bibleStudy;
        $this->limit = 10;
        $this->data['wysiwyg'] = true;
        $this->filter = [
            array('field' => 'q', 'type' => 'text', 'placeholder' => 'Search...')
        ];

        $this->head = [
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'image'),
            array('field' => 'type', 'title' => 'Type', 'text', 'database' => 'bible_types', 'where' => ''),
            array('field' => 'title_en', 'title' => 'Title (English)'),
            array('field' => 'title_kh', 'title' => 'Title (Khmer)'),
        ];

        $this->form = [
            array('field' => 'type', 'title' => 'Type', 'type' => 'select2', 'required' => true, 'validated' => 'required', 'database' => 'bible_types,id,name', 'where' => ''),
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'file', 'required' => true, 'validated' => 'required', 'accept' => 'image/*'),
            array('field' => 'title_en', 'title' => 'Title (English)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'caption_en', 'title' => 'Caption (English)', 'type' => 'wysiwyg', 'required' => true, 'validated' => 'required'),
            array('field' => 'title_kh', 'title' => 'Title (Khmer)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'caption_kh', 'title' => 'Caption (Khmer)', 'type' => 'wysiwyg', 'required' => true, 'validated' => 'required'),
        ];
    }

    public function search()
    {
        $q = request()->get('q');
        $type = request()->get('type');
        $query = $this->model;

        if (!empty($q)) {
            $query = $query->where(function ($query) use ($q) {
                $query->where('title_en', 'like', '%' . $q . '%')
                    ->orWhere('title_kh', 'like', '%' . $q . '%');
            });
        }

        if (!empty($type)) {
            $query = $query->where('type', $type);
        }

        return $query->paginate($this->limit);
    }

    /**
     * @return Application|Factory|View
     */
    public function getIndex(): View|Factory|Application
    {
        $this->data['result'] = $this->search();
        $buttonAppend = [
            array('name' => 'File', 'action' => '/admin/biblestudy/add-doc', 'btn' => 'btn btn-info', 'icon' => 'fa fa-folder-open', 'parent' => 'admin/biblestudy'),
            array('name' => 'Doc', 'action' => '/admin/biblestudy/view-doc', 'btn' => 'btn btn-warning', 'icon' => 'fa fa-eye', 'parent' => 'admin/biblestudy'),
        ];
        $this->appendButton($this->data, $buttonAppend);
        $this->init();
        return view('admin.bible', ['data' => $this->data]);
    }

    /**
     * @return Factory|View|Application
     */
    public function getAdd(): Factory|View|Application
    {
        $this->data['form'] = $this->form;
        $this->addRelation($this->form);
        return view('admin.add', ['data' => $this->data]);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getEdit($id): mixed
    {
        $this->data['back'] = "user";
        $this->form[1] =  array('field' => 'photo', 'title' => 'Photo', 'type' => 'file', 'accept' => 'image/*');
        $this->data['form'] = $this->form;
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
     * Add a new document form.
     */
    public function addDocForm()
    {
        $this->form = [
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
     * A description of the entire PHP function.
     */
    public function addDoc(Request $request, $bibleId)
    {
        $this->addDocForm();
        $this->data['add_title'] = 'Add Document';
        $this->data['form'] = $this->form;
        $this->addRelation($this->form);
        $this->data['bible'] = BibleStudy::where('id', $bibleId)->first();
        return view('admin.add-doc', ['data' => $this->data]);
    }

    public function postDoc(Request $request)
    {
        $data = $request->except('_token');
        $this->addDocForm();
        $request->validate($this->validationForm());

        if ($request->file('thumbnail')) {
            $data['thumbnail'] = Helper::imageUpload('images', $request->file('thumbnail'));
        }

        if ($request->file('file')) {
            $data['file'] = Helper::imageUpload('files', $request->file('file'));
        }

        Library::create($data);
        return redirect()->route('adminbiblestudy.getIndex')->with('success', 'Added Successfully');
    }

    public function viewDocForm()
    {
        $this->head = [
            array('field' => 'thumbnail', 'title' => 'Thumbnail', 'type' => 'image'),
            array('field' => 'file', 'title' => 'File', 'type' => 'file'),
            array('field' => 'title_en', 'title' => 'Title (English)'),
            array('field' => 'description_en', 'title' => 'Description (English)'),
            array('field' => 'title_kh', 'title' => 'Title (Khmer)'),
            array('field' => 'description_kh', 'title' => 'Description (Khmer)'),
            array('field' => 'url', 'title' => 'URL'),

        ];
    }

    public function viewDoc($id)
    {
        $this->viewDocForm();
        $this->data['result'] = Library::where('bible_study_id', $id)->paginate(20);
        $this->data['head'] = $this->head;
        $this->data['bible'] = BibleStudy::where('id', $id)->first();
        return view('admin.view-doc', ['data' => $this->data]);
    }

    /**
     * Custom view detail
     *
     * @param Request $request description
     * @param $bibleId description
     * @param  $id description
     */
    public function viewDocDetail(Request $request, $bibleId, $id)
    {
        $this->viewDocForm();
        $this->addDocForm();
        $this->data['bible'] = $this->model->findOrFail($bibleId);
        $this->data['form'] = $this->form;
        $this->data['head'] = $this->head;
        $this->data['find'] = Library::where('id', $id)->first();

        return view('admin.doc-detail', ['data' => $this->data]);
    }

    /**
     * Custom view of edit template
     *
     * @param Request $request description
     * @param  $bibleId description
     * @param $id description
     */
    public function editDoc(Request $request, $bibleId, $id)
    {
        $this->viewDocForm();
        $this->addDocForm();
        $this->form[0] = array('field' => 'thumbnail', 'title' => 'Thumbnail', 'type' => 'file', 'accept' => 'image/*');
        $this->data['form'] = $this->form;
        $this->data['head'] = $this->head;
        $this->addRelation($this->form);
        $this->data['find'] = Library::where('id', $id)->first();
        $this->data['bible'] = $this->model->findOrFail($bibleId);

        return view('admin.edit-doc', ['data' => $this->data]);
    }


    public function updateDoc(Request $request)
    {
        $this->viewDocForm();
        $this->addDocForm();
        $this->form[0] = array('field' => 'thumbnail', 'title' => 'Thumbnail', 'type' => 'file', 'accept' => 'image/*');

        $data = $request->except('_token', 'save');
        $request->validate($this->validationForm());

        if ($request->file('thumbnail')) {
            $data['thumbnail'] = Helper::imageUpload('images', $request->file('thumbnail'));
        }

        if ($request->file('file')) {
            $data['file'] = Helper::imageUpload('files', $request->file('file'));
        }

        Library::where('id', $request->get('id'))->update($data);

        return redirect("/admin/biblestudy/view-doc/{$data['bible_study_id']}?parent=admin/biblestudy")->with('message', 'The data has been updated');
    }


    public function deleteDoc(Request $request, $bibleId, $id)
    {
        Library::where('id', $id)->delete();
        return redirect("/admin/biblestudy/view-doc/{$bibleId}?parent=admin/biblestudy")->with('message', 'The data has been deleted');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request): mixed
    {
        $this->form[1] =  array('field' => 'photo', 'title' => 'Photo', 'type' => 'file', 'accept' => 'image/*');
        return parent::update($request);
    }
}
