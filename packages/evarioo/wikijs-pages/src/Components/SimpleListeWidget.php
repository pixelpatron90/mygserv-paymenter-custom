<?php

namespace Evarioo\WikiJSPages\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SimpleListeWidget extends Component
{

    public function mount()
    {
        //
    }

    public function render()
    {
        return view('evarioo-wikijs::widget');
    }

}