<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Custumer;

class CreateCustumer extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';

    public function render()
    {
        return view('livewire.create-custumer');
    }

    public function save(){
        $validated = $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:custumers|max:255',
            'phone' => 'required|unique:custumers|max:50'
        ]);

        Custumer::create($validated);

        $this->reset();
    }
}
