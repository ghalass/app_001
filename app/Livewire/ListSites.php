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
    public $test = "ok";

    public $title = "Create Site";
    public $event = "create-site";

    public $title1 = "Create Site Vitals";
    public $event1 = "create-site-vitals";


    public SiteForm $form;
    public $operation = 'add';
    public $search = '';


    /** */
    public $name;
    public $description;

    // input fields on update validation
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name'          => 'required|unique:sites,name,',
            'description'   => 'required'
        ]);
    }

    public function storeSiteData()
    {
        // on form submit validation
        // $this->validate([
        //     'name'          => 'required|unique:sites,name,',
        //     'description'   => 'required'
        // ]);
        // // Add Site Data
        // $site = new Site();
        // $site->name = $this->name;
        // $site->description = $this->description;

        // $site->save();

        // for hide modal after add site success
        $this->dispatch('close-modal');

        // $this->dispatch('success', ['message' => 'Ajouté avec succès!']);
    }

    /** */

    /***  */
    // public $modal = false;

    // function openModal() // abrirModal
    // {
    //     $this->modal = true;
    // }
    // function closeModal() //cerrarModal
    // {
    //     $this->modal = false;
    // }
    // function create()
    // {
    //     // $this->clearFields(); // limpiarCampos
    //     $this->openModal(); // abrirModal
    // }
    /*** */


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
        // $sites = Site::paginate($this->pagination);
        if (!$this->q) {
            $sites = Site::orderBy('id', 'desc')->paginate($this->pagination);
        } else {
            $sites = Site::where('name', 'like', '%' . $this->q . '%')
                ->orWhere('description', 'like', '%' . $this->q . '%')
                ->orderBy('id', 'desc')
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

    public function exportExcelQuery()
    {
        return (new SitesExport)->download('sites.xlsx');
    }

    public function exportExcelView()
    {
        return Excel::download(new SitesDataExport, 'sites-list.xlsx');
    }

    public function exportPdfView()
    {
        $sites = Site::all();
        // dd($sites);
        $pdf = Pdf::loadView('livewire.exports.pdf.sites', array('sites' => $sites))
            ->setPaper('a4');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'liste des sites.pdf');
    }
}