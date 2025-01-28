<?php

namespace Evarioo\WikiJSPages\Components;

use config;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SimpleListeWidget extends Component
{

    public function mount()
    {
        //
    }

    public function loadData()
    {

        $response = Http::withHeaders([
            'X-API-Key' => config('evarioo-wikijs::wikijs.api_key'),
            'Content-Type' => 'application/json'
        ])->get(config('evarioo-wikijs::wikijs.api_url') . '/api/v1/pages');

        dd($response->json());
    }

    public function render()
    {
        return view('evarioo-wikijs::widget.simple-list', [
            'data' => $this->loadData()
        ]);
    }

}