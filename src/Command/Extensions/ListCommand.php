<?php

namespace FriendsOfWp\DeveloperCli\Command\Extensions;

use FriendsOfWp\DeveloperCli\Command\Command;
use FriendsOfWp\DeveloperCli\Util\ApiHelper;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListCommand extends Command
{
    const EXTENSION_LIST_ENDPOINT = 'https://raw.githubusercontent.com/friends-of-wp/wp-dev-cli-extensions/main/extensions.yml';

    protected static $defaultName = 'cli:extensions:list';
    protected static $defaultDescription = 'List all extensions in the directory.';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $directory = ApiHelper::YamlResponseRequest(self::EXTENSION_LIST_ENDPOINT);

        $elements = [];

        $headlines = ['Identifier', 'Name', 'Description'];

        foreach ($directory['extensions'] as $identifier => $extension) {
            $elements[] = [
                $identifier,
                $extension['name'],
                wordwrap($extension['description'], 70) . "\n",
            ];
        }

        $this->renderTable($output, $headlines, $elements);

        return SymfonyCommand::SUCCESS;
    }

}
