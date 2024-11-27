<?php

namespace App\Livewire;

use App\Exports\SitesDataExport;
use App\Exports\SitesExport;
use App\Livewire\Forms\SiteForm;
use App\Models\Site;

use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

use Barryvdh\DomPDF\Facade\Pdf;

class ListSites extends Component
{
    public SiteForm $form;
    public $operation = 'add';
    public $search = '';

    public function edit(?Site $site)
    {
        $this->form->setSite($site);
        $this->operation = 'edit';
    }
    public function delete(?Site $site)
    {
        $this->form->setSite($site);
        $this->operation = 'delete';
    }
    public function submit()
    {
        sleep(2);

        switch ($this->operation) {
            case 'add':
                $this->form->store();
                $this->dispatch('success', ['message' => 'Ajouté avec succès!']);
                break;
            case 'edit':
                $this->form->update();
                $this->dispatch('info', ['message' => 'Modifié avec succès!']);
                break;
            case 'delete':
                $this->form->destroy();
                $this->dispatch('warning', ['message' => 'Supprimé avec succès!']);
                break;
            default:
                $this->dispatch('error', ['message' => 'Aucune opération n"est choisi!']);
                break;
        }
        $this->operation = 'add';
    }

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $q;
    public $pagination = 10;

    public function render()
    {
        // sleep(1);
        // $sites = Site::paginate($this->pagination);
        if (!$this->q) {
            $sites = Site::paginate($this->pagination);
        } else {
            $sites = Site::where('name', 'like', '%' . $this->q . '%')
                ->orWhere('description', 'like', '%' . $this->q . '%')
                ->paginate($this->pagination);
        }
        return view('livewire.list-sites', [
            'sites' => $sites
        ]);
    }


    // Q in updatedQ for q variable of search
    public function updatedQ()
    {
        $this->resetPage();
    }

    public function exportExcel()
    {
        return (new SitesExport)->download('sites.xlsx');
    }

    public function exportExcel2()
    {
        return Excel::download(new SitesDataExport, 'sites-list.xlsx');
    }

    public function viewPDF()
    {
        $sites = Site::all();
        // dd($sites);
        $pdf = Pdf::loadView('pdf.sites', array('sites' => $sites))
            ->setPaper('a4');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'liste des sites.pdf');
    }
}
