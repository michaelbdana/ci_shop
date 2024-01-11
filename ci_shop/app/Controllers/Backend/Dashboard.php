<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;

use function PHPUnit\Framework\isNull;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['page_name'] = "Dashboard";
        $data['user_id'] = auth()->id();
        return view('backend/dashboard', $data);
    }
}
