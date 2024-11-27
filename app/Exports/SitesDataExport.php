<?php

namespace App\Exports;

use App\Models\Site;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SitesDataExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $sites;

    public function __construct()
    {
        $this->sites = Site::all();
    }

    public function view(): View
    {
        return view('livewire.sites', [
            'sites' => $this->sites
        ]);
    }
}