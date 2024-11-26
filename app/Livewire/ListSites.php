<?php

namespace App\Livewire;

use App\Livewire\Forms\SiteForm;
use App\Models\Site;
use Livewire\Component;
use Livewire\WithPagination;

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

    public function updatedQ()
    {
        $this->resetPage();
    }
}
