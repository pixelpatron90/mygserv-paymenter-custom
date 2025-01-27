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

    public function loadData()
    {
        $response = Http::withHeaders([
            'X-API-Key' => $this->config('apiKey'),
            'Content-Type' => 'application/json'
        ])->get(config('evarioo-wikijs::wikijs.api_url'));

        dd($response);
    }

    public function render()
    {
        return view('evarioo-wikijs::widget.simple-list', [
            'data' => $this->loadData()
        ]);
    }

}