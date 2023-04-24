<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

abstract class SimpleStep implements Step
{
    private Configuration $configuration;
    private InputInterface $input;
    private OutputInterface $output;

    /**
     * The constructor
     */
    public function __construct(Configuration $configuration, InputInterface $input, OutputInterface $output)
    {
        $this->configuration = $configuration;
        $this->input = $input;
        $this->output = $output;
    }

    protected function askYesNoQuestion(string $messageWithQuestionmark, QuestionHelper $questionHelper): bool
    {
        $answer = $questionHelper->ask($this->getInput(), $this->getOutput(), new Question($messageWithQuestionmark . ' (yes/no)? '));

        if (!$answer) {
            return true;
        }

        $answer = strtolower($answer);
        if ($answer === 'n' || $answer === "no") {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @inheritDoc
     */
    public function ask(QuestionHelper $questionHelper): void
    {

    }

    /**
     * This function writes a standardized warning to the command line.
     */
    protected function warning(OutputInterface $output, string $message)
    {
        $output->writeln('');
        $output->writeln('<bg=yellow>' . $message . '</>');
        $output->writeln('');
    }

    /**
     * Return the plugin configuration.
     */
    protected function getConfiguration(): Configuration
    {
        return $this->configuration;
    }

    /**
     * Return the input interface.
     */
    protected function getInput(): InputInterface
    {
        return $this->input;
    }

    /**
     * Return the output interface.
     */
    protected function getOutput(): OutputInterface
    {
        return $this->output;
    }
}
