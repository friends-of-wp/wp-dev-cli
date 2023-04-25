<?php

namespace FriendsOfWp\DeveloperCli\Command;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends SymfonyCommand
{
    protected function writeWarning(OutputInterface $output): void
    {
        $output->writeln("\n<error>                                                                  </error>");
        $output->writeln('<error>  This command is not finished yet. It may not work as expected.  </error>');
        $output->writeln("<error>                                                                  </error>\n");
    }

    protected function writeInfo(OutputInterface $output, $message = ''): void
    {
        $output->writeln("\n<error>                                                                  </error>");
        $output->writeln('<error>  ' . $message . '  </error>');
        $output->writeln("<error>                                                                  </error>\n");
    }
}
