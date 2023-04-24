<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Question\Question;

/**
 * @todo it should be possible to configure via a config file and not only via command
 *       line parameters.
 *
 * @todo ask for @since. This should always be the newest WordPress version (taken from the WP API).
 *       This API should also be used to validate the version number.
 *
 * @todo ask for license
 */
class InitializeStep extends SimpleStep
{
    /**
     * @inheritDoc
     */
    public function ask(QuestionHelper $questionHelper): void
    {
        $pluginName = $this->askPluginName($questionHelper);

        /**
         * @todo ask for: version number, author
         * @todo ask for composer
         * @todo ask for settings (this should be reusable or stand-alone)
         */
        $pluginDescription = $questionHelper->ask($this->getInput(), $this->getOutput(), new Question('Please enter the description of the plugin: ', ''));

        $isAdminPlugin = $this->askYesNoQuestion('Is this plugin an admin plugin', $questionHelper);

        $configuration = $this->getConfiguration();

        $configuration->setIsAdminPlugin($isAdminPlugin);

        $outputDir = $this->getInput()->getArgument('outputDir');
        $pluginVersion = '1.0.0';

        $configuration->setPluginName($pluginName);
        $configuration->setOutputDir($outputDir);
        $configuration->setPluginVersion($pluginVersion);
        $configuration->setPluginDescription($pluginDescription);
    }

    /**
     * @todo check if similar name is already existing (use plugin db for that)
     */
    private function askPluginName(QuestionHelper $questionHelper): string
    {
        $validPluginName = false;
        $pluginName = '';
        while (!$validPluginName) {
            $pluginName = $questionHelper->ask($this->getInput(), $this->getOutput(), new Question('Please enter the name of the plugin (e.g. Acme Security): ', ''));
            $validPluginName = $this->isValidPluginName($pluginName);

            if (!$validPluginName) {
                $this->warning($this->getOutput(), 'The given plugin name it not valid. It has to have at least three characters.');
            }
        }

        return $pluginName;
    }

    private function isValidPluginName(string $pluginName): bool
    {
        if (strlen($pluginName) < 3) {
            return false;
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function run(): string
    {
        return "Initialized plugin configuration";
    }
}
