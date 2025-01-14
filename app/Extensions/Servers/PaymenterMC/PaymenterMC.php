<?php

namespace App\Extensions\Servers\PaymenterMC;

use App\Helpers\ExtensionHelper;
use App\Classes\Extensions\Server;

class PaymenterMC extends Server
{
    /**
     * Get the extension metadata
     *
     * @return array
     */
    public function getMetadata()
    {
        return [
            'display_name' => 'PaymenterMC',
            'version' => '1.0.0',
            'author' => 'Ethan Primmer',
            'website' => 'https://iungo.tech',
        ];
    }

    /**
     * Get all the configuration for the extension
     *
     * @return array
     */
    public function getConfig()
    {
        return [
            [
                'name' => 'server_ip',
                'type' => 'text',
                'friendlyName' => 'Server IP',
                'required' => true,
            ],
            [
                'name' => 'server_port',
                'type' => 'text',
                'friendlyName' => 'Plugin Port',
                'required' => true,
            ],
            [
                'name' => 'server_apiToken',
                'type' => 'text',
                'friendlyName' => 'Plugin API Token',
                'required' => true,
            ],
        ];
    }

    /**
     * Get product config
     *
     * @param array $options
     * @return array
     */
    public function getProductConfig($options)
    {
        return [
            [
                'name' => 'commands',
                'friendlyName' => 'Commands',
                'type' => 'text',
                'required' => true,
                'description' => 'Commands to be executed when the payment is done<br>Can be splitted by using a comma',
            ],
        ];
    }

    public function getUserConfig()
    {
        return [
            [
                'name' => 'username',
                'friendlyName' => 'In-Game username',
                'type' => 'text',
                'required' => true,
                'description' => 'Username product should be sent to',
            ],
        ];
    }

    private function sendWebhook(string $data): void
    {

        $serverIp = ExtensionHelper::getConfig('PaymenterMC', 'server_ip');
        $serverPort = ExtensionHelper::getConfig('PaymenterMC', 'server_port');
        $serverEndpoint = '/webhooks/complete';
        $serverApiToken = ExtensionHelper::getConfig('PaymenterMC', 'server_apiToken');

        $url = "http://$serverIp:$serverPort$serverEndpoint";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-type: application/json',
            'Authorization: Bearer ' . $serverApiToken,
        ]);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        curl_close($curl);
    }

    public function createServer($user, $parmas, $order, $product, $configurableOptions)
    {
        $parmasJson = json_encode($parmas);
        $this->sendWebhook($parmasJson);
    }

}
