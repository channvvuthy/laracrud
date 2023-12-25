<?php

namespace App\Http\Controllers\admin;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class StockController extends LaraCRUDController
{
    /**
     * @return Application|Factory|View
     */
    public function getIndex(): View|Factory|Application
    {
        return view('admin.stock.index', ['data' => $this->data]);
    }

    /**
     * @return Factory|View|Application
     */
    public function getAdd(): Factory|View|Application
    {
        return view('admin.stock.add', ['data' => $this->data]);
    }

}
