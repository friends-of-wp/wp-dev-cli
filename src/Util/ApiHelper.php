<?php

namespace FriendsOfWp\DeveloperCli\Util;

use GuzzleHttp\Client;

abstract class ApiHelper
{
    /**
     * Send a GET request to an API that returns JSON content.
     */
    static public function JsonResponseRequest(string $endpoint)
    {
        $client = new Client();
        $response = $client->get($endpoint);
        return json_decode((string)$response->getBody(), true);
    }
}
