<?php

namespace App\Traits;

use Helper;
use Illuminate\Support\Str;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait CommonTrait
{
    public function validationForm(): array
    {
        $validated = [];

        foreach ($this->form as $form) {
            if ($this->isRequired($form)) {
                $validated[$form['field']] = $this->getValidatedValue($form);
            }
        }

        return $validated;
    }

    public function isRequired(array $form): bool
    {
        return isset($form['required']) && $form['required'];
    }

    public function getValidatedValue(array $form): string
    {
        $value = $form['validated'];

        if (Str::contains($value, "unique")) {
            try {
                $value .= "," . $form['field'] . "," . request()->get('id');
            } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            }
        }

        return $value;
    }

    public function processFileUpload(Request $request, string $key, array &$fields): void
    {

       
        if ($request->hasFile($key)) {
            $fileName = Helper::imageUpload("images", $request->file($key));
            $fields[$key] = $fileName;
        }
    }

    public function hashPasswordIfPresent(Request $request, string $key, array &$fields): void
    {
        if ($key === 'password' && $request->input('password')) {
            $fields['password'] = bcrypt($request->input('password'));
        }
    }

    public function shouldJoin($head): bool
    {
        return isset($head['join']) && $head['join'];
    }

    public function performJoin($query, $model, $head, &$select, &$data): void
    {
        $relation = explode(",", $head['on']);
        
        $query->leftJoin($head['join'], $model->table . '.' . $relation[0], '=', $head['join'] . '.' . $relation[1]);

        $colSelect = explode(",", $head['column']);
        $select = array_merge($select, $colSelect);

        if (isset($head['dropdown']) && $head['dropdown']) {
            $this->handleDropdown($head, $data);
        }
    }

    public function handleDropdown($head, &$data): void
    {
        $dropdown = explode(",", $head['dropdown']);
        $dropdownKey = array_shift($dropdown);
        $data[$dropdownKey] = DB::table($head['join'])->select($dropdown)->paginate($this->limit);
    }

}
