<?php

namespace FriendsOfWp\DeveloperCli\Command\Plugin;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;
use FriendsOfWp\DeveloperCli\Boilerplate\Step\CopyTemplatesStep;
use FriendsOfWp\DeveloperCli\Boilerplate\Step\CreatingSettingsConfigStep;
use FriendsOfWp\DeveloperCli\Boilerplate\Step\Exception\UnableToCreateException;
use FriendsOfWp\DeveloperCli\Boilerplate\Step\InitializeStep;
use FriendsOfWp\DeveloperCli\Boilerplate\Step\RenameMasterFileStep;
use FriendsOfWp\DeveloperCli\Boilerplate\Step\ReplacingPlaceholdersSteps;
use FriendsOfWp\DeveloperCli\Command\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BoilerplateCreateCommand extends Command
{
    protected static $defaultName = 'plugin:boilerplate:create';
    protected static $defaultDescription = 'Create an OOP plugin boilerplate with all dependencies.';

    /**
     * @var \FriendsOfWp\DeveloperCli\Boilerplate\Step\Step[]
     */
    private array $steps = [];

    protected function configure()
    {
        $this->addArgument('outputDir', InputArgument::REQUIRED, 'The output directory for the plugin.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->initSteps();

        $this->writeWarning($output);

        $config = new Configuration();

        $this->ask($input, $output, $config);

        $output->writeln("\n<info>Starting plugin creation.</info>\n");

        $this->runSteps($output, $config);

        $output->writeln("\n\n<info>FINISHED</info>. Created new plugin boilerplate <comment>" . $config->getPluginName() . "</comment> in directory <comment>" . $config->getOutputDir() . "</comment>\n");

        return SymfonyCommand::SUCCESS;
    }

    private function ask(InputInterface $input, OutputInterface $output, Configuration &$configuration)
    {
        $questionHelper = $this->getHelper('question');

        foreach ($this->steps as $step) {
            try {
                $step->ask($configuration, $input, $output, $questionHelper);
            } catch (UnableToCreateException $e) {
                $message = "Unable to create boilerplate. " . $e->getMessage();
                $spaces = str_repeat(' ', strlen($message) + 4);

                $output->writeln("");
                $output->writeln('<error>' . $spaces . "</error>");
                $output->writeln("<error>  " . $message . "  </error>");
                $output->writeln('<error>' . $spaces . "</error>");
                $output->writeln("");

                die;
            }
        }
    }

    private function initSteps()
    {
        $this->steps = [
            new InitializeStep(),
            new CopyTemplatesStep(),
            new ReplacingPlaceholdersSteps(),
            new RenameMasterFileStep(),
            new CreatingSettingsConfigStep()
        ];
    }

    private function runSteps(OutputInterface $output, Configuration $configuration): void
    {
        $stepCount = 0;

        $numberOfSteps = count($this->steps);

        foreach ($this->steps as $step) {
            $stepCount++;
            $output->writeln('Step ' . $stepCount . '/' . $numberOfSteps . ': ' . $step->run($configuration));
        }
    }
}
