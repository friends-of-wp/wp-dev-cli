<?php

namespace FriendsOfWp\DeveloperCli\Command;

use FriendsOfWp\DeveloperCli\Util\OutputHelper;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends SymfonyCommand
{
    protected function writeWarning(OutputInterface $output, string $message): void
    {
        OutputHelper::writeErrorBox($output, $message);
    }

    protected function writeInfo(OutputInterface $output, string|array $message): void
    {
        OutputHelper::writeInfoBox($output, $message);
    }
}
