<?php

namespace FriendsOfWp\DeveloperCli\Util;

use GuzzleHttp\Client;
use Symfony\Component\Yaml\Yaml;

abstract class ApiHelper
{
    /**
     * Send a GET request to an API that returns JSON content.
     */
    static public function JsonResponseRequest(string $endpoint): array
    {
        $client = new Client();
        $response = $client->get($endpoint);
        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Send a GET request to an API that returns YAML content.
     */
    static public function YamlResponseRequest(string $endpoint): array
    {
        $client = new Client();
        $response = $client->get($endpoint);

        return Yaml::parse($response->getBody());
    }
}
