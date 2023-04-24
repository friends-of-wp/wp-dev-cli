<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;

class RenameMasterFileStep extends SimpleStep
{
    public function run(): string
    {
        $configuration = $this->getConfiguration();

        $from = $configuration->getOutputDir() . '/plugin/plugin-boilerplate.php';
        $to = $configuration->getOutputDir() . '/plugin/' . $configuration->getNormalizedPluginName() . '.php';

        rename($from, $to);

        return "Renamed ". Configuration::PLUGIN_BOILERPLATE_FILE . " to " . $configuration->getNormalizedPluginName() . '.php';
    }
}
