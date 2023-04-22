<?php

namespace FriendsOfWp\DeveloperCli\Command\WordPress\Directory;

use Fowp\WordPressPluginRetriever\Export\ComposeExporter;
use Fowp\WordPressPluginRetriever\Export\CsvExporter;
use Fowp\WordPressPluginRetriever\Export\SymfonyConsoleOutputExporter;
use Fowp\WordPressPluginRetriever\Retriever;
use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ExportCommand extends Command
{
    const REQUESTS_PER_PAGE = 400;

    protected static $defaultName = 'wordpress:directory:export';
    protected static $defaultDescription = 'Download all plugins information from the WordPress.org directory.';

    public function configure()
    {
        $this->addArgument('outputfile', InputArgument::REQUIRED, 'The CSV output file.');
        $this->addOption('numberOfPages', 'p', InputOption::VALUE_OPTIONAL, 'The number of pages that should be downloaded.', -1);
        parent::configure();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $retriever = new Retriever(new Client());

        $composeExporter = new ComposeExporter();
        $composeExporter->addExporter(new CsvExporter($input->getArgument('outputfile')));
        $composeExporter->addExporter(new SymfonyConsoleOutputExporter($output));

        $retriever->retrieve(self::REQUESTS_PER_PAGE, $input->getOption('numberOfPages'), $composeExporter);

        $output->writeln('<info>Successfully created CSV file (' . $input->getArgument('outputfile') . ').');

        return Command::SUCCESS;
    }
}
