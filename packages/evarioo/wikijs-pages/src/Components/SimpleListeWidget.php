<?php

namespace Evarioo\WikiJSPages\Components;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SimpleListeWidget extends Component
{

    public $widget_title;
    public $api_url;
    public $api_token;

    public function mount()
    {
        $this->widget_title = config('wikijs.widget.title');
        $this->api_url = config('wikijs.wikijs.api_url');
        $this->api_token = config('wikijs.wikijs.api_key');
    }

    public function loadData()
    {
        $apiUrl = 'https://wiki.mygserv.de/graphql';
        $apiToken = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcGkiOjEsImdycCI6NSwiaWF0IjoxNzM4MDA2MTEzLCJleHAiOjE4MzI2Nzg5MTMsImF1ZCI6InVybjp3aWtpLmpzIiwiaXNzIjoidXJuOndpa2kuanMifQ.lnKS0UiauR7LylJIEK3gnV3xsN59nwDpXqAWD-WVckjh4R7TXD05sOGBmRuivmaUiLbWpEouw-P63yit1qN5DjF5p2-I-DpHvWUSHQpJmLCbrlIV9KT3jndle1ghj-tEgi_w3WYvKZ27P0a3wYkl2WvSqGUNCk9oMDWz_d6Wd7ovOLX5Ow2BxWua4eQwI-l4mQ8Fc-1TzCxeaKKpiiwVks_JWBw4FWp-9FabXAklcHVWzHsAbyH3en5D679tyKBh0vecbRLiLsAKjQ0So6B3IDw3pzbhiQaRpAz1_4uiOQOLcrIHK_5S6R4LCdgJuAYQIevqaBo9uqT4pQGp2GkZWA';

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->api_token,
        ];

        $query = <<<'GRAPHQL'
        {
          pages {
            list(orderBy: TITLE) {
              id
              path
              title
            }
          }
        }
        GRAPHQL;

        $body = [
            'query' => $query,
            'variables' => new \stdClass(), // Leere Variablen
        ];

        $response = Http::withHeaders($headers)->post($this->api_url, $body);

        if (!$response->successful()) {
            $widgetdata = (object) [
                'status' => $response->status(),
                'message' => $response->body()
            ];
            return $widgetdata;
        }

        $widgetdata = (object) [
            'widget_title' => $this->widget_title,
            'pages' => $response->json()['data']['pages']['list'],
        ];

        return $widgetdata;

    }

    public function render()
    {
        return view('evarioo-wikijs::widget.simple-list', [
            'data' => $this->loadData(),
        ]);
    }

}