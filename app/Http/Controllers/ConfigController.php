<?php

namespace App\Http\Controllers;

use App\Models\Engin;
use App\Models\Lubrifiant;
use App\Models\Parc;
use App\Models\Site;
use App\Models\Typelubrifiant;
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
        $total_engins = Engin::count();
        $total_typelubrifiants = Typelubrifiant::count();
        $total_lubrifiants = Lubrifiant::count();

        $data = [
            'total_sites' => $total_sites,
            'total_typeparcs' => $total_typeparcs,
            'total_parcs' => $total_parcs,
            'total_engins' => $total_engins,
            'total_typelubrifiants' => $total_typelubrifiants,
            'total_lubrifiants' => $total_lubrifiants
        ];

        return view('configs.index', $data);
    }
}
