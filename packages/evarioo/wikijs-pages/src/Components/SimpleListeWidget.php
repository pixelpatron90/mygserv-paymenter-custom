<?php

namespace Evarioo\WikiJSPages\Components;

use config;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
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

        $apiUrl = 'https://wiki.mygserv.de/graphql';
        $apiToken = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcGkiOjEsImdycCI6NSwiaWF0IjoxNzM4MDA2MTEzLCJleHAiOjE4MzI2Nzg5MTMsImF1ZCI6InVybjp3aWtpLmpzIiwiaXNzIjoidXJuOndpa2kuanMifQ.lnKS0UiauR7LylJIEK3gnV3xsN59nwDpXqAWD-WVckjh4R7TXD05sOGBmRuivmaUiLbWpEouw-P63yit1qN5DjF5p2-I-DpHvWUSHQpJmLCbrlIV9KT3jndle1ghj-tEgi_w3WYvKZ27P0a3wYkl2WvSqGUNCk9oMDWz_d6Wd7ovOLX5Ow2BxWua4eQwI-l4mQ8Fc-1TzCxeaKKpiiwVks_JWBw4FWp-9FabXAklcHVWzHsAbyH3en5D679tyKBh0vecbRLiLsAKjQ0So6B3IDw3pzbhiQaRpAz1_4uiOQOLcrIHK_5S6R4LCdgJuAYQIevqaBo9uqT4pQGp2GkZWA';

        // GraphQL-Abfrage
        $query = <<<GRAPHQL
        query {
            pages {
                id
                title
                path
                createdAt
                updatedAt
            }
        }
        GRAPHQL;

        $query2 = '{"query":"{\\r\\n  pages {\\r\\n    list (orderBy: TITLE) {\\r\\n      id\\r\\n      path\\r\\n      title\\r\\n    }\\r\\n  }\\r\\n}","variables":{}}';

        $response = Http::withToken($apiToken)
            ->post($apiUrl, [
                'query' => $query2,
            ]);

        // Ergebnis prüfen
        if ($response->successful()) {
            $pages = $response->json()['data']['pages']; // Extrahiere die Seiten-Daten
            return response()->json($pages); // Rückgabe als JSON
        } else {
            return response()->json([
                'error' => 'Failed to fetch pages',
                'status' => $response->status(),
                'message' => $response->body(),
            ], $response->status());
        }

    }

    public function loadData2()
    {

        // GraphQL-API URL
        $url = 'https://wiki.mygserv.de/graphql';

        // Headers für die Anfrage
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcGkiOjEsImdycCI6NSwiaWF0IjoxNzM4MDA2MTEzLCJleHAiOjE4MzI2Nzg5MTMsImF1ZCI6InVybjp3aWtpLmpzIiwiaXNzIjoidXJuOndpa2kuanMifQ.lnKS0UiauR7LylJIEK3gnV3xsN59nwDpXqAWD-WVckjh4R7TXD05sOGBmRuivmaUiLbWpEouw-P63yit1qN5DjF5p2-I-DpHvWUSHQpJmLCbrlIV9KT3jndle1ghj-tEgi_w3WYvKZ27P0a3wYkl2WvSqGUNCk9oMDWz_d6Wd7ovOLX5Ow2BxWua4eQwI-l4mQ8Fc-1TzCxeaKKpiiwVks_JWBw4FWp-9FabXAklcHVWzHsAbyH3en5D679tyKBh0vecbRLiLsAKjQ0So6B3IDw3pzbhiQaRpAz1_4uiOQOLcrIHK_5S6R4LCdgJuAYQIevqaBo9uqT4pQGp2GkZWA',
        ];

        // GraphQL-Query
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

        // Body der Anfrage
        $body = [
            'query' => $query,
            'variables' => new \stdClass(), // Leere Variablen
        ];

        // Sende POST-Anfrage
        $response = Http::withHeaders($headers)->post($url, $body);

        // Überprüfen, ob die Anfrage erfolgreich war
        if ($response->successful()) {
            // JSON-Ergebnis zurückgeben
            return response()->json($response->json());
        } else {
            // Fehlerbehandlung
            return response()->json([
                'error' => 'GraphQL request failed',
                'status' => $response->status(),
                'message' => $response->body(),
            ], $response->status());
        }

    }

    public function render()
    {
        dd($this->loadData2());
    }

}