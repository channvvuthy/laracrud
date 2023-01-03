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
        $this->init();
        return view('admincrud.edit', ['data' => $this->data]);
    }

    public function delete($id): mixed
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
        $this->model->where($this->pk, $request->get('id'))->update($request->except('_token', 'save'));
        return redirect($redirectUrl)->with('message', 'The data has been updated');
    }

    public function detail($id): mixed
    {
        $this->find = $this->model->findOrFail($id);

        $this->title = 'Detail of ' . $this->model->moduleName;
        $this->data['detail'] = $this->model->detail;
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
    public function findMix($model, $header, $id): mixed
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
        $query = $query->where($model->table . ".id", '=', $id);
        return $query->select($select)->get();
    }
}
