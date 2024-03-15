<?php

namespace App\Http\Controllers\admin;

use App\Models\ChurchService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Helper;

class ChurchServiceController extends LaraCRUDController
{
    /**
     * @param ChurchService $churchService
     */
    public function __construct(ChurchService $churchService)
    {
        parent::__construct();

        $this->model = $churchService;
        $this->limit = 10;
        $this->data['wysiwyg'] = true;

        $this->head = [
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'image'),
            array('field' => 'title_en', 'title' => 'Title (English)'),
            array('field' => 'title_kh', 'title' => 'Title (Khmer)'),
        ];

        $this->form = [
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'file', 'required' => true, 'validated' => 'required', 'accept' => 'image/*'),
            array('field' => 'title_en', 'title' => 'Title (English)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'title_kh', 'title' => 'Title (Khmer)', 'type' => 'text', 'required' => true, 'validated' => 'required'),
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
        $this->title = "Add new " . $this->model->moduleName;
        $this->data['form'] = $this->form;
        $this->data['back'] = $this->model->moduleName;
        $this->addSession();
        $this->addScript();
        return view('admin.add', ['data' => $this->data]);
    }


    /**
     * @param $id
     * @return mixed
     */
    /**
     * Retrieves the edit form for a specific record.
     *
     * @param mixed $id The ID of the record to edit.
     * @return mixed The view for editing the record.
     */
    public function getEdit($id): mixed
    {
        $this->data['find'] = $this->model->findOrFail($id);
        $this->form[0] = array('field' => 'photo', 'title' => 'Photo', 'type' => 'file', 'accept' => 'image/*');
        $this->data['form'] = $this->form;
        return view('admin.custom.church_edit', ['data' => $this->data]);
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
        return view('admin.custom.church_detail', ['data' => $this->data]);
    }

    public function addSession()
    {
        $htmlAttribute = <<<HTML
        <div class="mb-3 row">
           <label for="title_kh" class="col-sm-2 col-form-label">
           Time & Session<span class="text-danger">*</span>
           </label>
           <div class="col-sm-10">
              <div class="row mb-3 timetable">
                <div class="col-sm-3">
                    <input type="time" class="form-control" name="times[]" required placeholder="Time">
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="sessions[]" required placeholder="Session">
                </div>
                <div class="col-sm-4">
                    <input type="file" class="form-control" name="images[]" required style="padding-top:3px;" accept="image/*">
                </div>
                <div class="col-sm-2 d-flex align-items-center btn-plus">
                    <div class="bg-success p-1 rounded-circle d-flex justify-content-center align-items-center" style="cursor:pointer; width:28px; height: 28px;">
                    <i class="fa fa-plus"></i>
                    </div>
                </div>
                <div class="col-sm-2 d-flex align-items-center btn-minus d-none">
                    <div class="bg-danger p-1 rounded-circle d-flex justify-content-center align-items-center" style="cursor:pointer; width:28px; height: 28px;">
                    <i class="fa fa-minus"></i>
                    </div>
                </div>
              </div>
           </div>
        </div>
        HTML;
        $this->data['appendHTML'] = $htmlAttribute;
    }

    public function addScript()
    {
        $script = <<<HTML
        <script>
            $(".btn-plus").click(function(){
                var parentElement = $(this).parent();
                var clonedElement = parentElement.clone();
                clonedElement.find('.btn-plus').remove();
                clonedElement.find('.btn-minus').removeClass('d-none');
                parentElement.after(clonedElement);
            });

            $(document).on('click', '.btn-minus',function(){
                var parentElement = $(this).parent();
                parentElement.remove();
            });

        </script>
        HTML;
        $this->data['appendScript'] = $script;
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function postAdd(\Illuminate\Http\Request $request): Redirector|RedirectResponse|Application
    {
        $timetables = [];
        $redirectUrl = $request->get('save');

        if (!empty($request->times) && !empty($request->sessions)) {
            foreach ($request->times as $key => $time) {
                $timetables[] = [
                    'time' => $time,
                    'session' => $request->sessions[$key],
                    'image' => isset($request->images[$key]) ? Helper::imageUpload("images", $request->images[$key]) : null,
                ];
            }
        }

        $fields = $request->except('_token', 'save', 'times', 'sessions', 'images');

        foreach ($fields as $key => $params) {
            $this->processFileUpload($request, $key, $fields);
            $this->hashPasswordIfPresent($request, $key, $fields);
        }

        $fields['timetables'] = json_encode($timetables);

        $this->model->create($fields);

        return redirect($redirectUrl)->with('message', 'The data has been added');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request): mixed
    {
        $timetables = [];
        $redirectUrl = $request->get('save');
        $this->form[0] = array('field' => 'photo', 'title' => 'Photo', 'type' => 'file', 'accept' => 'image/*');

        if (!empty($request->times) && !empty($request->sessions)) {
            foreach ($request->times as $key => $time) {
                $timetables[] = [
                    'time' => $time,
                    'session' => $request->sessions[$key],
                    'image' => isset($request->images[$key]) ? Helper::imageUpload("images", $request->images[$key]) : null,
                ];
            }
        }

        $churchService = $this->model->findOrFail($request->get('id'));

        $oldTimetables = json_decode($churchService->timetables);

        if (!empty($oldTimetables) && !empty($timetables)) {
            $oldTimetables = $this->updateTimetables($oldTimetables, $timetables);
        }

        $fields = $request->except('_token', 'save', 'times', 'sessions', 'images');
        $fields['timetables'] = json_encode($oldTimetables);

        $request->validate($this->validationForm());

        foreach ($fields as $key => $params) {
            $this->processFileUpload($request, $key, $fields);
            $this->hashPasswordIfPresent($request, $key, $fields);
        }

        $this->model->where($this->pk, $request->get('id'))->update($fields);

        return redirect($redirectUrl)->with('message', 'The data has been updated');
    }

    /**
     * Update timetables with new information.
     *
     * @param array $oldTimetables The old timetables to be updated
     * @param array $newTimetables The new timetables containing updated information
     * @return array The updated timetables
     */
    public function updateTimetables($oldTimetables, $newTimetables)
    {
        foreach ($oldTimetables as $key => $oldTimetable) {
            if ($newTimetables[$key]['image']) {
                $oldTimetables[$key]->image = $newTimetables[$key]['image'];
            }

            $oldTimetables[$key]->session = $newTimetables[$key]['session'];
            $oldTimetables[$key]->time = $newTimetables[$key]['time'];
        }

        return $oldTimetables;
    }

    public function deleteSession($id, $index)
    {
        $churchService = $this->model->findOrFail($id);
        $timetables = json_decode($churchService->timetables, true);

        if (isset($timetables[$index])) {
            unset($timetables[$index]);

            $churchService->timetables = json_encode($timetables);

            $churchService->save();

            return redirect()->back()->with('message', 'The session has been successfully deleted.');
        } else {
            return redirect()->back()->with('error', 'Invalid session index.');
        }
    }
}
