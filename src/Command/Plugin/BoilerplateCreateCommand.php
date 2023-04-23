<?php

namespace FriendsOfWp\DeveloperCli\Command\Plugin;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;
use FriendsOfWp\DeveloperCli\Boilerplate\Step\Exception\UnableToCreateException;
use FriendsOfWp\DeveloperCli\Command\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class BoilerplateCreateCommand extends Command
{
    protected static $defaultName = 'plugin:boilerplate:create';
    protected static $defaultDescription = 'Create an OOP plugin boilerplate with all dependencies.';

    private string $configFile;

    /**
     * @var \FriendsOfWp\DeveloperCli\Boilerplate\Step\Step[]
     */
    private array $steps = [];

    protected function configure()
    {
        $this->addArgument('outputDir', InputArgument::REQUIRED, 'The output directory for the plugin.');
        $this->addOption('configFile', 'c', InputOption::VALUE_OPTIONAL, 'The configuration file.', false);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->initSteps($input->getOption('configFile'));

        $this->writeWarning($output);

        $config = new Configuration();

        $this->ask($input, $output, $config);

        $output->writeln("\n<info>Starting plugin creation.</info>\n");

        $this->runSteps($output, $config);

        $output->writeln("\n\n<info>FINISHED</info>. Created new plugin boilerplate <comment>" . $config->getPluginName() . "</comment> in directory <comment>" . $config->getOutputDir() . "</comment>\n");

        return SymfonyCommand::SUCCESS;
    }

    /**
     * Aks the user for the plugin configuration parameters.
     */
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

    private function initSteps(string $configFile)
    {
        if (!$configFile) {
            $configFile = __DIR__ . '/../../../config/boilerplate/default.yml';
        }

        $config = Yaml::parse(file_get_contents($configFile));

        foreach ($config['steps'] as $stepName) {
            $this->steps[] = new $stepName;
        }
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
