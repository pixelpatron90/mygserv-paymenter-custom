<?php

namespace Evarioo\WikiJSPages\Components;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

class SimpleListeWidget extends Component
{
    use WithPagination;
    public $per_page;

    public $widget_title;
    public $wiki_url;
    public $api_token;

    public function mount()
    {
        $this->per_page = (config('wikijs.widget.per_page') ? config('wikijs.widget.per_page') : 5);
        $this->widget_title = config('wikijs.widget.title');
        $this->wiki_url = config('wikijs.wikijs.wiki_url');
        $this->api_token = config('wikijs.wikijs.api_key');
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

        $slicedData = array_slice($response->json()['data']['pages']['list'], (request('page') ? request('page') - 1 : 0) * $this->per_page, $this->per_page);
        $paginatedData = new LengthAwarePaginator(
            $slicedData,
            count($response->json()['data']['pages']['list']),
            $this->per_page,
            request('page'),
            ['path' => url()->current()]
        );

        $widgetdata = (object) [
            'widget_title' => $this->widget_title,
            'wiki_url' => $this->wiki_url,
            'pages' => $paginatedData,
        ];

        return $widgetdata;

    }

    public function render()
    {
        return view('evarioo.wikijs.widget.simple-list', [
            'data' => $this->loadData(),
        ]);
    }

}