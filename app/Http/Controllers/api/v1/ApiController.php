<?php

namespace App\Http\Controllers\api\v1;

use App\Interfaces\ApiInterface;
use Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ApiController implements ApiInterface
{

    protected Model $model;
    protected $form = [];
    protected $edit = false;
    protected $edit_id = null;

    public function postAdd(Request $request): mixed
    {
        $field = $request->all();
        $request->validate($this->validationForm());

        foreach ($field as $key => $params) {
            if ($request->hasFile($key)) {
                $fileName = Helper::imageUpload("images", $request->file($key));
                $field[$key] = $fileName;
            }
            if ($request->input('password')) {
                $field["password"] = bcrypt($request->input('password'));
            }
        }

        $result = $this->model->create($field);
        return response()->json([
            'data' => $result
        ]);

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
}
