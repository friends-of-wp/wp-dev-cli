<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

class RenamePluginDirStep extends SimpleStep
{
    public function run(): string
    {
        $configuration = $this->getConfiguration();

        $from = $configuration->getOutputDir() . '/plugin/';
        $to = $configuration->getOutputDir() . '/' . $configuration->getNormalizedPluginName() . '/';

        rename($from, $to);

        return "Renamed plugin directory to " . $configuration->getNormalizedPluginName();
    }
}
