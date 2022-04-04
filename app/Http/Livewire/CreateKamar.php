<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class CreateKamar extends Component
{
    use WithFileUploads;

    public $gambars = [];

    public function submit () {
        dd ($this->all());
    }



    public function render()
    {


        return view('livewire.create-kamar');
    }
}
