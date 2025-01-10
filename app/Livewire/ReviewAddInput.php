<?php

namespace App\Livewire;

use Livewire\Component;

class ReviewAddInput extends Component
{
    //#[Session]
    public $inputs = [];
    public $advantages = [];
    public $disadvantages = [];
    public $style;

    public function mount()
    {
        $this->inputs = ['']; 
    }

    public function addInput()
    {
        $this->inputs[] = '';
    }

    public function removeInput($index) 
    {
        unset($this->inputs[$index]);
        $this->inputs = array_values($this->inputs);
    }
    public function saveAdvantages($value)
    {
        $this->advantages[] = $value;
        $this->dispatch('advantagesSaved', advantages: $this->advantages);
    }

    public function saveDisadvantages($value)
    {
        $this->disadvantages[] = $value;
        $this->dispatch('disadvantagesSaved', disadvantages: $this->disadvantages);
    }

    public function render()
    {
        return view('livewire.review-add-input');
    }
}
