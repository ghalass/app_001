<?php


namespace App\Exports;

use App\Models\Site;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SitesExport implements FromQuery, WithHeadings
{
    use Exportable;

    private $colmuns = ['name', 'description'];

    function query()
    {
        $sites = Site::query()
            ->select($this->colmuns)
            ->orderBy('name', 'asc');
        return $sites;
    }

    public function headings(): array
    {
        return $this->colmuns;
    }
}