<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;

class RenamePluginDirStep extends SimpleStep
{
    public function run(Configuration $configuration): string
    {
        $from = $configuration->getOutputDir() . '/plugin/';
        $to = $configuration->getOutputDir() . '/' . $configuration->getNormalizedPluginName() . '/';

        rename($from, $to);

        return "Renamed plugin directory to " . $configuration->getNormalizedPluginName();
    }
}
