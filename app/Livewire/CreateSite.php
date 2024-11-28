<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class CreateSite extends Component
{
    public $name;
    public $email;
    public $phone;
    public function render()
    {
        return view('livewire.create-site');
    }

    #[On('create-site')]
    public function saveRecord()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $this->reset();
        $this->resetValidation();
        //savaing of the site
        // $this->js("alert('Site saved')");
    }

    #[On('create-site-close')]
    public function close()
    {
        $this->reset();
        $this->resetValidation();
        // $this->js("alert('Site model closed')");
    }
}