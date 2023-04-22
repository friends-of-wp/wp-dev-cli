<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Steps;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;

class RenameMasterFileStep implements Step
{
    public function run(Configuration $configuration): string
    {
        return "Renamed plugin-boilerplate.php to " . $configuration->getPluginName() . '.php';
    }
}
