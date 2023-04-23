<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;

class ReplacingPlaceholdersSteps extends SimpleStep
{
    const LIMITERS = '##';

    private array $files = [
        'src/plugin-boilerplate.php',
        'readme.md'
    ];

    public function run(Configuration $configuration): string
    {
        foreach ($this->files as $file) {
            $this->replaceInFile($file, $configuration);
        }

        return "Replacing all variables in the boilerplate directory";
    }

    private function replaceInFile(string $file, Configuration $configuration)
    {
        $replacements = [
            'PLUGIN_NAME' => $configuration->getPluginName(),
            'PLUGIN_DESCRIPTION' => $configuration->getPluginDescription(),
            'PLUGIN_VERSION' => $configuration->getPluginVersion(),
        ];

        $filename = $configuration->getOutputDir() . '/' . $file;

        $content = file_get_contents($filename);

        foreach ($replacements as $key => $replacement) {
            $search = self::LIMITERS . $key . self::LIMITERS;
            $content = str_replace($search, $replacement, $content);
        }

        file_put_contents($filename, $content);
    }
}
