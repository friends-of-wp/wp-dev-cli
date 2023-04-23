<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;

class RenameMasterFileStep extends SimpleStep
{
    public function run(Configuration $configuration): string
    {
        $from = $configuration->getOutputDir() . '/src/plugin-boilerplate.php';
        $to = $configuration->getOutputDir() . '/src/' . $configuration->getNormalizedPluginName() . '.php';

        rename($from, $to);

        return "Renamed plugin-boilerplate.php to " . $configuration->getNormalizedPluginName() . '.php';
    }
}
