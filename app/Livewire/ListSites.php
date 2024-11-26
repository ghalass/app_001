<?php

namespace App\Livewire;

use App\Models\Site;
use Livewire\Component;

class ListSites extends Component
{
    // #[Validate('required|unique:sites,name')]
    public $id = "";
    public $name = "";
    // #[Validate('required')]
    public $description = "";
    public $operation = 'add';

    public function edit(Site $site)
    {
        // alert($site->name);
        $this->id = $site->id;
        $this->name = $site->name;
        $this->description = $site->description;
        $this->operation = 'edit';
    }
    public function delete(Site $site)
    {
        // alert('delete');
        $this->id = $site->id;
        $this->name = $site->name;
        $this->description = $site->description;
        $this->operation = 'delete';
    }
    public function submit()
    {
        switch ($this->operation) {
            case 'add':
                $validated = $this->validate([
                    'name' => 'required|unique:sites,name',
                    'description' => 'required',
                ]);
                Site::create($validated);
                $this->reset();
                $this->dispatch('success', ['message' => 'Ajouté avec succès!']);
                break;
            case 'edit':
                $validated = $this->validate([
                    'name' => 'required|unique:sites,name,' . $this->id,
                    'description' => 'required',
                ]);
                Site::create($validated);
                $this->reset();
                $this->dispatch('info', ['message' => 'Modifié avec succès!']);
                break;
            case 'delete':
                $site = Site::findOrFail($this->id);
                $site->delete();
                $this->reset();
                $this->dispatch('warning', ['message' => 'Supprimé avec succès!']);
                break;
            default:
                $this->dispatch('error', ['message' => 'Aucune opération n"est choisi!']);
                break;
        }
    }

    public function render()
    {
        $sites = Site::paginate(10);
        return view('livewire.list-sites', compact('sites'));
    }
}