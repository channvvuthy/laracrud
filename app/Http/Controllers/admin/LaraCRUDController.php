<?php

namespace App\Http\Controllers\admin;

use App\Interfaces\LaraCRUDInterface;
use App\Traits\CommonTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Helper;
use Illuminate\Support\Facades\DB;

class LaraCRUDController extends CRUDBaseController implements LaraCRUDInterface
{
    use CommonTrait;

    public string $title = "VSM";
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
    public Model $model;
    public mixed $result;
    public array $data = [];
    public array $head = [];
    public int $col = 12;
    public int $grid = 12;
    public array $form = [];
    public mixed $find;
    public bool $wysiwyg = false;
    public bool $select2 = false;
    public int $action_with = 250;

    public function __construct()
    {
        parent::__construct();
        $this->init();
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
        $this->data['method'] = $this->method;
        $this->data['method'] = $this->method;
        $this->data['col'] = $this->col;
        $this->data['grid'] = $this->grid;
        $this->data['wysiwyg'] = $this->wysiwyg;
        $this->data['select2'] = $this->select2;
        $this->data['action_with'] = $this->action_with;
        $this->data['form'] = $this->form;
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
        return view('admin.index', ['data' => $this->data]);
    }

    /**
     * @return Application|Factory|View
     */
    public function getAdd(): View|Factory|Application
    {
        $this->init();
        return view('admin.add', ['data' => $this->data]);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function postAdd(Request $request): Redirector|RedirectResponse|Application
    {
        $redirectUrl = $request->get('save');
        $fields = $request->except('_token', 'save');

        $request->validate($this->validationForm());

        foreach ($fields as $key => $params) {
            $this->processFileUpload($request, $key, $fields);
            $this->hashPasswordIfPresent($request, $key, $fields);
        }

        $this->model->create($fields);

        return redirect($redirectUrl)->with('message', 'The data has been added');
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
        return view('admin.edit', ['data' => $this->data]);
    }

    /**
     * @param $id
     * @return Redirector|RedirectResponse|Application
     */
    public function delete($id): Redirector|RedirectResponse|Application
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
        $fields = $request->except('_token', 'save');

        $request->validate($this->validationForm());

        foreach ($fields as $key => $params) {
            $this->processFileUpload($request, $key, $fields);
            $this->hashPasswordIfPresent($request, $key, $fields);
        }

        $this->model->where($this->pk, $request->get('id'))->update($fields);

        return redirect($redirectUrl)->with('message', 'The data has been updated');
    }

    public function detail($id): mixed
    {
        $this->find = $this->model->findOrFail($id);
        $this->title = 'Detail of ' . $this->model->moduleName;
        $this->data['back'] = $this->model->moduleName;
        $this->init();
        return view('admin.detail', ['data' => $this->data]);
    }

    /**
     * @param $model
     * @param $header
     * @return LengthAwarePaginator
     */
    public function getJoin($model, $header): LengthAwarePaginator
    {
        $query = DB::table($model->table);
        $select = [];
        

        foreach ($header as $head) {
            if ($this->shouldJoin($head)) {
                $this->performJoin($query, $model, $head, $select, $data);
            }
        }
        array_unshift($select, $model->table . ".*");
        return $query->select($select)->paginate($this->limit);
    }

    /**
     * @param $model
     * @param $header
     * @param $id
     * @param null $data
     * @return object|null
     */
    public function findJoin($model, $header, $id, &$data = null): null|object
    {
        $query = DB::table($model->table);
        $select = [];

        foreach ($header as $head) {
            if ($this->shouldJoin($head)) {
                $this->performJoin($query, $model, $head, $select, $data);
            }
        }

        array_unshift($select, $model->table . ".*");
        $query->where($model->table . ".id", '=', $id);

        return $query->select($select)->first();
    }


    /**
     * @param $form
     * @return void
     */
    public function addRelation(&$form): void
    {
        foreach ($this->form as $relation) {
            if (isset($relation['database']) && $relation['database']) {
                $database = explode(",", $relation['database']);

                $table = array_shift($database);
                

                $query = DB::table($table)->select($database);

                if (isset($relation['where']) && $relation['where']) {
                    list($column, $value) = explode(",", $relation['where']);
                    $query->where($column, '=', $value);
                }

                $result = $query->limit($this->limit)->get();
                $this->data[$relation['field']] = $result;
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
    public function findId($id): mixed
    {
        return $this->model->findOrFail($id);
    }
}
