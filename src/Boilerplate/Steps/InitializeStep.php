<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Steps;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class InitializeStep extends SimpleStep
{
    public function ask(Configuration $configuration, InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): void
    {
        /**
         * @todo the name must not be empty
         * @todo check if similar name is already existing (use plugin db for that)
         */
        $pluginName = $questionHelper->ask($input, $output, new Question('Please enter the name of the plugin (e.g. Acme Security): ', ''));

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

    public function run(Configuration $configuration): string
    {
        return "Initializing plugin configuration";
    }
}
