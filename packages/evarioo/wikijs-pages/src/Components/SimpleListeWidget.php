<?php

namespace Evarioo\WikiJSPages\Components;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SimpleListeWidget extends Component
{

    public $widget_title;
    public $wiki_url;
    public $api_token;

    public function mount()
    {
        $this->widget_title = config('wikijs.widget.title');
        $this->wiki_url = config('wikijs.wikijs.wiki_url');
        $this->api_token = config('wikijs.wikijs.api_key');
    }

    public function get_wiki_page_url($page)
    {
        $url = $this->wiki_url . '/' . $page;
        return $url;
    }

    public function loadData()
    {
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

        $response = Http::withHeaders($headers)->post($this->wiki_url . '/graphql', $body);

        if (!$response->successful()) {
            $widgetdata = (object) [
                'status' => $response->status(),
                'message' => $response->body()
            ];
            return $widgetdata;
        }

        $widgetdata = (object) [
            'widget_title' => $this->widget_title,
            'wiki_page_url' => $this->get_wiki_page_url,
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