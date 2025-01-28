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

        $url = 'https://wiki.mygserv.de';
        $endpoint = '/v1/pages';
        $apiToken = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcGkiOjEsImdycCI6NSwiaWF0IjoxNzM4MDA2MTEzLCJleHAiOjE4MzI2Nzg5MTMsImF1ZCI6InVybjp3aWtpLmpzIiwiaXNzIjoidXJuOndpa2kuanMifQ.lnKS0UiauR7LylJIEK3gnV3xsN59nwDpXqAWD-WVckjh4R7TXD05sOGBmRuivmaUiLbWpEouw-P63yit1qN5DjF5p2-I-DpHvWUSHQpJmLCbrlIV9KT3jndle1ghj-tEgi_w3WYvKZ27P0a3wYkl2WvSqGUNCk9oMDWz_d6Wd7ovOLX5Ow2BxWua4eQwI-l4mQ8Fc-1TzCxeaKKpiiwVks_JWBw4FWp-9FabXAklcHVWzHsAbyH3en5D679tyKBh0vecbRLiLsAKjQ0So6B3IDw3pzbhiQaRpAz1_4uiOQOLcrIHK_5S6R4LCdgJuAYQIevqaBo9uqT4pQGp2GkZWA';

        $result = Http::withHeaders([
            'X-API-Key' => config('evarioo-wikijs::wikijs.api_key'),
            'Content-Type' => 'application/json'
        ])->get($url . $endpoint);

        $response = json_decode($result->getBody());

        dd($response);
    }

    public function render()
    {
        return view('evarioo-wikijs::widget.simple-list', [
            'data' => $this->loadData()
        ]);
    }

}