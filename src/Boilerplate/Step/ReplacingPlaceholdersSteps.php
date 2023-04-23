<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;

/**
 * This step replaces all placeholder variables in the plugin destination directory.
 *
 * @author nils.langner@startwind.io
 */
class ReplacingPlaceholdersSteps extends SimpleStep
{
    const LIMITERS = '##';

    /**
     * The files where all placeholders are replaced.
     *
     * @var string[]
     */
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
            'PLUGIN_NORMALIZED_NAME' => $configuration->getNormalizedPluginName()
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
