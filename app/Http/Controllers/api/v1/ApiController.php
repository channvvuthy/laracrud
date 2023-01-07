<?php

namespace App\Http\Controllers\api\v1;
use App\Interfaces\ApiInterface;
use Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
/**
 * @OA\Info(title="J Learning", version="0.1")
 */
class ApiController implements ApiInterface
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected Model $model;
    protected array $form = [];
    protected bool $edit = false;
    protected int $edit_id;
    protected int $limit = 20;

    public function postAdd(Request $request)
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
                if (Str::contains($form['validated'], "unique")) {
                    try {
                        $validated[$form['field']] = $form['validated'] . "," . $form['field'] . "," . request()->get('id');
                    } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
                    }
                }
            }
        }
        return $validated;
    }

}
