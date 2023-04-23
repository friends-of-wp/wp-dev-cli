<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class SimpleStep implements Step
{
    public function ask(Configuration $configuration, InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): void
    {

    }

    protected function warning(OutputInterface $output, string $message)
    {
        $output->writeln('');
        $output->writeln('<bg=yellow>' . $message . '</>');
        $output->writeln('');
    }
}
