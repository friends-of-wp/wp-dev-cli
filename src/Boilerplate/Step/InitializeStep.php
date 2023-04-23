<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

/**
 * @todo it should be possible to configure via a config file and not only via command
 *       line parameters.
 *
 * @todo ask for @since. This should always be the newest WordPress version (taken from the WP API).
 */
class InitializeStep extends SimpleStep
{
    public function ask(Configuration $configuration, InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): void
    {
        $pluginName = $this->askPluginName($questionHelper, $input, $output);

        /**
         * @todo ask for: version number, author
         * @todo ask for license
         * @todo ask for composer
         * @todo ask for settings (this should be reusable or stand-alone)
         */
        $pluginDescription = $questionHelper->ask($input, $output, new Question('Please enter the description of the plugin: ', ''));
        $outputDir = $input->getArgument('outputDir');
        $pluginVersion = '1.0.0';

        $configuration->setPluginName($pluginName);
        $configuration->setOutputDir($outputDir);
        $configuration->setPluginVersion($pluginVersion);
        $configuration->setPluginDescription($pluginDescription);
    }

    /**
     * @todo check if similar name is already existing (use plugin db for that)
     */
    private function askPluginName(QuestionHelper $questionHelper, InputInterface $input, OutputInterface $output): string
    {
        $validPluginName = false;
        $pluginName = '';
        while (!$validPluginName) {
            $pluginName = $questionHelper->ask($input, $output, new Question('Please enter the name of the plugin (e.g. Acme Security): ', ''));
            $validPluginName = $this->isValidPluginName($pluginName);

            if (!$validPluginName) {
                $this->warning($output, 'The given plugin name it not valid. It has to have at least three characters.');
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

    public function run(Configuration $configuration): string
    {
        return "Initialized plugin configuration";
    }
}
