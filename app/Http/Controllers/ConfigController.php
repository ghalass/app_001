<?php

namespace App\Http\Controllers;

use App\Models\Parc;
use App\Models\Site;
use App\Models\Typeparc;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConfigController extends Controller
{
    function index(): View
    {
        $total_sites = Site::count();
        $total_typeparcs = Typeparc::count();
        $total_parcs = Parc::count();

        $data = [
            'total_sites' => $total_sites,
            'total_typeparcs' => $total_typeparcs,
            'total_parcs' => $total_parcs
        ];

        return view('configs.index', $data);
    }
}
