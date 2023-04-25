<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

class RenamePluginDirStep extends SimpleStep
{
    /**
     * @inheritDoc
     */
    public function run(): string
    {
        $configuration = $this->getConfiguration();

        $from = $configuration->getOutputDir() . '/plugin/';
        $to = $configuration->getOutputDir() . '/' . $configuration->getNormalizedPluginName() . '/';

        if (file_exists($to)) {
            $this->deleteDirectory($to);
        }

        rename($from, $to);

        return "Renamed plugin directory to " . $configuration->getNormalizedPluginName();
    }

    private function deleteDirectory($path): void
    {
        if (empty($path) || $path == '/') {
            return;
        }

        is_file($path) ? @unlink($path) : array_map(__METHOD__, glob($path . '/*')) == @rmdir($path);
    }
}
