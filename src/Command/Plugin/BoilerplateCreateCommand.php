<?php

namespace FriendsOfWp\DeveloperCli\Command\Plugin;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;
use FriendsOfWp\DeveloperCli\Boilerplate\Step\Exception\UnableToCreateException;
use FriendsOfWp\DeveloperCli\Command\Command;
use FriendsOfWp\DeveloperCli\Util\ConfigFileLoader;
use FriendsOfWp\DeveloperCli\Util\OutputHelper;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use FriendsOfWp\DeveloperCli\Boilerplate\Step\Step;

class BoilerplateCreateCommand extends Command
{
    const INPUT_OUTPUT_DIR = 'outputDir';

    protected static $defaultName = 'plugin:boilerplate:create';
    protected static $defaultDescription = 'Create an OOP plugin boilerplate with all dependencies.';

    /**
     * A list of steps that will be processed for creating a new plugin.
     *
     * @var Step[]
     */
    private array $steps = [];

    protected function configure()
    {
        $this->addArgument(self::INPUT_OUTPUT_DIR, InputArgument::REQUIRED, 'The output directory for the plugin.');
        $this->addOption('configFile', 'c', InputOption::VALUE_OPTIONAL, 'The configuration file.', false);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        OutputHelper::writeInfoBox($output, "This command creates a plugin boiler plate. Please answer some questions to individualize it.");

        $config = new Configuration();

        $this->initSteps($input->getOption('configFile'), $config, $input, $output);

        $this->ask($output);

        $output->writeln("\n<info>Starting plugin creation.</info>\n");

        $this->runSteps($output, $config);

        $output->writeln("\n\n<info>FINISHED</info>. Created new plugin boilerplate <comment>" . $config->getPluginName() . "</comment> in directory <comment>" . $config->getOutputDir() . "</comment>\n");

        return SymfonyCommand::SUCCESS;
    }

    /**
     * Aks the user for the plugin configuration parameters.
     */
    private function ask(OutputInterface $output)
    {
        foreach ($this->steps as $step) {
            try {
                $step->ask();
            } catch (UnableToCreateException $e) {
                $message = "Unable to create boilerplate. " . $e->getMessage();
                OutputHelper::writeErrorBox($output, $message);
                die(SymfonyCommand::FAILURE);
            }
        }
    }

    private function initSteps(string $configFile, Configuration $configuration, InputInterface $input, OutputInterface $output)
    {
        $questionHelper = $this->getHelper('question');

        $config = ConfigFileLoader::loadYamlConfig($configFile, __DIR__ . '/../../../config/boilerplate/default.yml');

        if (array_key_exists('parameters', $config)) {
            foreach ($config['parameters'] as $key => $value) {
                $configuration->setParameter($key, $value);
            }
        }

        foreach ($config['steps'] as $stepName) {
            $this->steps[] = new $stepName($configuration, $input, $output, $questionHelper);
        }
    }

    private function runSteps(OutputInterface $output, Configuration $configuration): void
    {
        $stepCount = 0;

        $numberOfSteps = count($this->steps);

        foreach ($this->steps as $step) {
            $stepCount++;
            $output->writeln('Step ' . $stepCount . '/' . $numberOfSteps . ': ' . $step->run());
        }
    }
}
