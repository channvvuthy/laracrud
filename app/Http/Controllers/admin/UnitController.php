<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends LaraCRUDController
{
    /**
     * @param Unit $unit
     */
    public function __construct(Unit $unit)
    {

        $this->model = $unit;
        $this->limit = 10;

        $this->head = [
            array('field' => 'title', 'title' => 'Name'),
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'image'),
            array('field' => 'description', 'title' => 'Description'),
            array('field' => 'status', 'title' => 'Status'),
        ];

        $this->form = [
            array('field' => 'title', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'file', 'accept' => 'image/*', 'validated' => 'required'),
            array('field' => 'description', 'title' => 'Description', 'type' => 'text'),
            array('field' => 'status', 'title' => 'Status', 'type' => 'status'),

        ];
        parent::__construct();
    }
}
