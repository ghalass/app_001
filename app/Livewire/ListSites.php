<?php

namespace App\Livewire;

use App\Livewire\Forms\SiteForm;
use App\Models\Site;
use Livewire\Component;

class ListSites extends Component
{
    public SiteForm $form;
    public $operation = 'add';

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

    public function render()
    {
        $sites = Site::paginate(10);
        return view('livewire.list-sites', compact('sites'));
    }
}