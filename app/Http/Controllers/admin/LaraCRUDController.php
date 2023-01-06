<?php

namespace App\Http\Controllers\admin;

use App\Interfaces\LaraCRUDInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Helper;
use Illuminate\Support\Facades\DB;

class LaraCRUDController extends CRUDBaseController implements LaraCRUDInterface
{
    public string $title = "LARACRUD";
    public int $limit = 20;
    public string $pk = "id";
    public string $order_by = "id";
    public string $order = "desc";
    public bool $has_action = true;
    public bool $edit = true;
    public bool $view = true;
    public bool $delete = true;
    public bool $add = true;
    public bool $export = false;
    public bool $import = false;
    public array $filter = [];
    public bool $display_id = true;
    public $model;
    public $result;
    public array $data = [];
    public array $head = [];
    public int $col = 12;
    public int $grid = 12;
    public array $form = [];
    public $find;
    public bool $wysiwyg = false;
    public bool $select2 = false;
    public int $action_with = 250;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    public function init(): void
    {
        $this->data['title'] = $this->title;
        $this->data['has_action'] = $this->has_action;
        $this->data['edit'] = $this->edit;
        $this->data['delete'] = $this->delete;
        $this->data['add'] = $this->add;
        $this->data['view'] = $this->view;
        $this->data['export'] = $this->export;
        $this->data['import'] = $this->import;
        $this->data['filter'] = $this->filter;
        $this->data['display_id'] = $this->display_id;
        $this->data['pk'] = $this->pk;
        $this->data['head'] = $this->head;
        $this->data['result'] = $this->result;
        $this->data['method'] = $this->method;
        $this->data['method'] = $this->method;
        $this->data['col'] = $this->col;
        $this->data['grid'] = $this->grid;
        $this->data['find'] = $this->find;
        $this->data['wysiwyg'] = $this->wysiwyg;
        $this->data['select2'] = $this->select2;
        $this->data['action_with'] = $this->action_with;
        $this->data['form'] = $this->form;
    }

    /**
     * @param $model
     * @return void
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function paginate(): mixed
    {
        return $this->model->orderBy($this->order_by, $this->order)->paginate($this->limit);
    }

    /**
     * @return Application|Factory|View
     */
    public function getIndex(): mixed
    {
        return view('admincrud.index', ['data' => $this->data]);
    }

    /**
     * @return Application|Factory|View
     */
    public function getAdd(): View|Factory|Application
    {
        return view('admincrud.add', ['data' => $this->data]);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function postAdd(Request $request): Redirector|RedirectResponse|Application
    {
        $redirectUrl = $request->get('save');
        $field = $request->except('_token', 'save');
        $request->validate($this->validationForm());

        foreach ($field as $key => $params) {
            if ($request->hasFile($key)) {
                $fileName = Helper::imageUpload("images", $request->file($key));
                $field[$key] = $fileName;
            }
        }

        $this->model->create($field);
        return redirect($redirectUrl)->with('message', 'The data has been added');
    }

    /**
     * @return array
     */
    public function validationForm(): array
    {
        $validated = [];
        foreach ($this->form as $form) {
            if (isset($form['required']) && $form['required']) {
                $validated[$form['field']] = $form['validated'];
            }
        }
        return $validated;
    }

    public function getEdit($id): mixed
    {
        $this->find = $this->model->findOrFail($id);
        $this->title = 'Edit ' . $this->model->moduleName;
        $this->data['back'] = $this->model->moduleName;
        $this->init();
        return view('admincrud.edit', ['data' => $this->data]);
    }

    /**
     * @param $id
     * @return \Application|\RedirectResponse|\Redirector
     */
    public function delete($id): \Application|\RedirectResponse|\Redirector
    {
        $this->model->destroy($id);
        return redirect(Helper::indexUrl())->with('message', 'The data has been deleted');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request): mixed
    {
        $redirectUrl = $request->get('save');
        $request->validate($this->validationForm());
        $field = $request->except('_token', 'save');

        foreach ($field as $key => $params) {
            if ($request->hasFile($key)) {
                $fileName = Helper::imageUpload("images", $request->file($key));
                $field[$key] = $fileName;
            }
        }
        $this->model->where($this->pk, $request->get('id'))->update($field);
        return redirect($redirectUrl)->with('message', 'The data has been updated');
    }

    public function detail($id): mixed
    {
        $this->find = $this->model->findOrFail($id);
        $this->title = 'Detail of ' . $this->model->moduleName;
        $this->data['back'] = $this->model->moduleName;
        $this->init();
        return view('admincrud.detail', ['data' => $this->data]);
    }

    /**
     * @param $model
     * @param $header
     * @return LengthAwarePaginator|mixed
     */
    public function getJoin($model, $header): mixed
    {
        $query = DB::table($model->table);
        $select = [];
        foreach ($header as $head) {
            if (isset($head['join']) && $head['join']) {
                $relation = explode(",", $head['on']);
                $query = $query->join($head['join'], $model->table . '.' . $relation[0], '=', $head['join'] . '.' . $relation[1]);
                $colSelect = explode(",", $head['column']);
                foreach ($colSelect as $col) {
                    $select[] = $col;
                }
            }
        }
        array_unshift($select, $model->table . ".*");
        return $query->select($select)->paginate($this->limit);
    }


    /**
     * @param $model
     * @param $header
     * @param $id
     * @return LengthAwarePaginator|mixed
     */
    public function findJoin($model, $header, $id, &$data = null): mixed
    {
        $query = DB::table($model->table);
        $select = [];
        foreach ($header as $head) {
            if (isset($head['join']) && $head['join']) {
                $relation = explode(",", $head['on']);
                $query = $query->join($head['join'], $model->table . '.' . $relation[0], '=', $head['join'] . '.' . $relation[1]);
                $colSelect = explode(",", $head['column']);
                foreach ($colSelect as $col) {
                    $select[] = $col;
                }

                if (isset($head['dropdown']) && $head['dropdown']) {
                    $dropdown = explode(",", $head['dropdown']);
                    $dropdownKey = $dropdown[0];
                    unset($dropdown[0]);
                    $data[$dropdownKey] = DB::table($head['join'])->select($dropdown)->paginate($this->limit);
                }
            }


        }
        array_unshift($select, $model->table . ".*");
        $query = $query->where($model->table . ".id", '=', $id);
        return $query->select($select)->first();
    }


    /**
     * @param $form
     * @return void
     */
    public function addRelation(&$form): void
    {
        foreach ($this->form as $form) {
            if (isset($form['database']) && $form['database']) {
                $database = explode(",", $form['database']);
                $table = $database[0];
                unset($database[0]);
                $query = DB::table($table)->select($database);
                if (isset($form['where']) && $form['where']) {
                    $cond = explode(",", $form['where']);
                    $query = $query->where($cond[0], '=', $cond[1]);
                }
                $query = $query->limit($this->limit)->get();
                $this->data[$form['field']] = $query;
            }
        }
    }

    /**
     * @param $head
     * @param $field
     * @return void
     */
    public function addField(&$head, $field): void
    {
        if (count($field)) {
            foreach ($field as $f) {
                $head[] = $f;
            }
        }
    }

    /**
     * @param $data
     * @param $button
     * @return void
     */
    public function appendButton(&$data, $button): void
    {
        if (is_array($button)) {
            if (count($button)) {
                $data['appendedButton'] = $button;
            }
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findbyId($id): mixed
    {
        return $this->model->findOrFail($id);
    }
}
