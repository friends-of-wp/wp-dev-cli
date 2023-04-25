<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;
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
    public function ask(): void
    {
        /**
         * @todo ask for: version number, author
         * @todo ask for composer
         * @todo ask for settings (this should be reusable or stand-alone)
         */
        $pluginName = $this->askPluginName();
        $pluginDescription = $this->askQuestion(new Question('Please enter the description of the plugin: '), Configuration::PARAM_PLUGIN_DESCRIPTION);
        $pluginVersion = $this->askQuestion(new Question('Please enter the version of the plugin (example: 1.0.0): '), Configuration::PARAM_PLUGIN_VERSION);

        $configuration = $this->getConfiguration();
        $configuration->setPluginDescription($pluginDescription);
        $configuration->setPluginName($pluginName);
        $configuration->setPluginVersion($pluginVersion);
    }

    /**
     * @todo check if similar name is already existing (use plugin db for that)
     */
    private function askPluginName(): string
    {
        $validPluginName = false;
        $firstQuestion = true;
        while (!$validPluginName) {
            $pluginName = $this->askQuestion(new Question('Please enter the name of the plugin (e.g. Acme Security): '), Configuration::PARAM_PLUGIN_NAME, !$firstQuestion);
            $firstQuestion = false;
            $validPluginName = $this->isValidPluginName($pluginName);

            if (!$validPluginName) {
                $this->writeWarning('The given plugin name "' . $pluginName . '" it not valid. It has to have at least three characters.');
            }
        }

        return $pluginName;
    }

    private function isValidPluginName(?string $pluginName): bool
    {
        if (is_null($pluginName)) {
            return false;
        }
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
