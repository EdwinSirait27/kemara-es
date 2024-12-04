<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardControllerAdmin extends Controller
{
    public function index()
    {
        return view('dashboardAdmin.dashboardAdmin');

    }
}
