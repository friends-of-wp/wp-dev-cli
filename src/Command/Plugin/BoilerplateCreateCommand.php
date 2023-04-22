<?php

namespace FriendsOfWp\DeveloperCli\Command\Plugin;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;
use FriendsOfWp\DeveloperCli\Boilerplate\Steps\CopyTemplatesStep;
use FriendsOfWp\DeveloperCli\Boilerplate\Steps\CreatingSettingsConfigStep;
use FriendsOfWp\DeveloperCli\Boilerplate\Steps\RenameMasterFileStep;
use FriendsOfWp\DeveloperCli\Boilerplate\Steps\ReplacingPlaceholdersSteps;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class BoilerplateCreateCommand extends Command
{
    protected static $defaultName = 'plugin:boilerplate:create';
    protected static $defaultDescription = 'Create an OOP plugin boilerplate with all dependencies.';

    protected function configure()
    {
        $this->addArgument('outputDir', InputArgument::REQUIRED, 'The output directory for the plugin.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $output->writeln('');
        $output->writeln('<error>                                                                           </error>');
        $output->writeln('<error>  This command is not finished yet. The created plugin will not work yet.  </error>');
        $output->writeln('<error>                                                                           </error>');
        $output->writeln('');

        /**
         * @todo the name must not be empty
         * @todo check if similar name is already existing (use plugin db for that)
         */
        $pluginName = $helper->ask($input, $output, new Question('Please enter the name of the plugin (e.g. Acme Security): ', ''));

        /**
         * @todo ask for: version number, author
         * @todo ask for license
         * @todo ask for composer
         * @todo ask for settings (this should be reusable or stand-alone)
         */
        $pluginDescription = $helper->ask($input, $output, new Question('Please enter the description of the plugin: ', ''));
        $outputDir = $input->getArgument('outputDir');
        $pluginVersion = '1.0.0';

        $config = new Configuration(
            $pluginName,
            $pluginDescription,
            $pluginVersion,
            $outputDir
        );

        $output->writeln('');
        $output->writeln('');

        $output->writeln("<info>Starting plugin creation.</info>\n");

        $this->runSteps($output, $config);

        $output->writeln("\n\n<info>FINISHED</info>. Created new plugin boilerplate <comment>" . $pluginName . "</comment> in directory <comment>" . $outputDir . '</comment>');
        $output->writeln('');

        return Command::SUCCESS;
    }

    private function runSteps(OutputInterface $output, Configuration $configuration): void
    {
        $steps = [
            new CopyTemplatesStep(),
            new ReplacingPlaceholdersSteps(),
            new RenameMasterFileStep(),
            new CreatingSettingsConfigStep()
        ];

        $stepCount = 0;

        foreach ($steps as $step) {
            $stepCount++;
            $output->writeln('Step ' . $stepCount . '/' . count($steps) . ': ' . $step->run($configuration));
        }
    }
}
