<?php

namespace Evarioo\WikiJSPages\Components;

use Illuminate\Http\Request;
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

    function paginate_results($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (LengthAwarePaginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $offset = ($page - 1) * $perPage;

        return new LengthAwarePaginator(
            $items->slice($offset, $perPage),
            $items->count(),
            $perPage,
            $page,
            $options
        );
    }

    public function loadData(Request $request)
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

        $perPage = 10; // Anzahl der Elemente pro Seite
        $page = $request->get('page', 1);
        $pages = $this->paginate_results($response->json()['data']['pages']['list'], $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        $widgetdata = (object) [
            'widget_title' => $this->widget_title,
            'wiki_url' => $this->wiki_url,
            'pages' => $pages,
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