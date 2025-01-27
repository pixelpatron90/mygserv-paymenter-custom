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
        if (!config('evarioo-wikijs::simple-list-view') == null) {
            return view('evarioo-wikijs::simple-list-view');
        } else {
            return view('evarioo-wikijs::widget');
        }

    }

}