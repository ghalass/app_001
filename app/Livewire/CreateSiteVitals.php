<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class CreateSiteVitals extends Component
{
    public $pressure;
    public $weight;
    public $height;
    public $temperature;
    public function render()
    {
        return view('livewire.create-site-vitals');
    }
    #[On('create-site-vitals')]
    public function saveRecord()
    {
        $this->validate([
            'pressure' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'temperature' => 'required',
        ]);
        $this->reset();
        $this->resetValidation();
        //savaing of the site
        $this->js("alert('Site vitals saved')");
    }

    #[On('create-site-vitals-close')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->js("alert('Site vitals model closed')");
    }
}