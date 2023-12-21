<?php

namespace App\Traits;

use Helper;
use Illuminate\Support\Str;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Illuminate\Http\Request;
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
}
