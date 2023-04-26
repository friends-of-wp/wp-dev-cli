<?php

namespace FriendsOfWp\DeveloperCli\Command;

use FriendsOfWp\DeveloperCli\Util\OutputHelper;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends SymfonyCommand
{
    protected function writeWarning(OutputInterface $output, string|array $message): void
    {
        OutputHelper::writeErrorBox($output, $message);
    }

    protected function writeInfo(OutputInterface $output, string|array $message): void
    {
        OutputHelper::writeInfoBox($output, $message);
    }

    /**
     * Render a table with the statistics.
     */
    protected function renderTable(OutputInterface $output, array $headers, array $rows): void
    {
        $table = new Table($output);
        $table->setHeaders($headers);
        $table->setRows($rows);
        $table->render();
    }
}
