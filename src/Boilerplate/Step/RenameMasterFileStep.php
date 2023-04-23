<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;

class RenameMasterFileStep extends SimpleStep
{
    public function run(Configuration $configuration): string
    {
        return "Renamed plugin-boilerplate.php to " . $configuration->getPluginName() . '.php';
    }
}
