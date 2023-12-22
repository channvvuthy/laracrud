<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends LaraCRUDController
{
    /**
     * @param Supplier $supplier
     */
    public function __construct(Supplier $supplier)
    {

        $this->model = $supplier;
        $this->limit = 10;

        $this->head = [
            array('field' => 'company_name', 'title' => 'Company Name'),
            array('field' => 'name', 'title' => 'Name'),
            array('field' => 'phone', 'title' => 'Phone'),
            array('field' => 'email', 'title' => 'Email'),
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'image'),
            array('field' => 'address', 'title' => 'Address'),
        ];

        $this->form = [
            array('field' => 'company_name', 'title' => 'Company Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'phone', 'title' => 'Phone', 'type' => 'text'),
            array('field' => 'email', 'title' => 'Email', 'type' => 'text'),
            array('field' => 'photo', 'title' => 'Photo', 'type' => 'file', 'accept' => 'image/*'),
            array('field' => 'address', 'title' => 'Address', 'type' => 'textarea'),

        ];
        parent::__construct();
    }
}
