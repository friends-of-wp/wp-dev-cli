<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;

/**
 * This step replaces all placeholder variables in the plugin destination directory.
 *
 * @author nils.langner@startwind.io
 */
class ReplacingPlaceholdersStep extends SimpleStep
{
    const LIMITERS = '##';

    /**
     * The files where all placeholders are replaced.
     *
     * @var string[]
     */
    private array $files = [
        Configuration::PLUGIN_DIR . '/' . Configuration::PLUGIN_BOILERPLATE_FILE,
        'readme.md'
    ];

    /**
     * @inheritDoc
     */
    public function run(): string
    {
        foreach ($this->files as $file) {
            $this->replaceInFile($file);
        }

        return "Replaced all variables in the boilerplate directory";
    }

    private function replaceInFile(string $file)
    {
        $configuration = $this->getConfiguration();

        $replacements = [
            'PLUGIN_NAME' => $configuration->getPluginName(),
            'PLUGIN_DESCRIPTION' => $configuration->getPluginDescription(),
            'PLUGIN_VERSION' => $configuration->getPluginVersion(),
            'PLUGIN_NORMALIZED_NAME' => $configuration->getNormalizedPluginName(),
            'PLUGIN_UNIQUE_NAME_CONST' => $configuration->getConstantPluginName()
        ];

        $filename = $configuration->getOutputDir() . '/' . $file;
        $this->enrichFile($filename, $replacements, self::LIMITERS);
    }
}
