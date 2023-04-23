<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;
use FriendsOfWp\DeveloperCli\Boilerplate\Step\Exception\UnableToCreateException;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CopyTemplatesStep extends SimpleStep
{
    public function ask(Configuration $configuration, InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): void
    {
        if (file_exists($configuration->getOutputDir())) {
            $output->writeln('');
            $overWrite = $questionHelper->ask($input, $output, new Question('The output dir is already existing. Do you want to overwrite it (yes/no)? '));
            if ($overWrite === 'n' || $overWrite === "no") {
                throw new UnableToCreateException('Output directory already exists and will not be overwritten.');
            }
        }
    }

    public function run(Configuration $configuration): string
    {
        $destinationDirectory = $configuration->getOutputDir();
        $sourceDirectory = __DIR__ . '/../../../boilerplate/';

        $this->prepareDirectory($destinationDirectory);

        $this->recurseCopy($sourceDirectory, $destinationDirectory);

        return "Copied boilerplate templates from 'boilerplate' to '$destinationDirectory'.";
    }

    /**
     * Create the directory if not existing
     *
     * @param string $directory
     * @return void
     */
    private function prepareDirectory(string $directory): void
    {
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
    }

    private function recurseCopy(string $sourceDirectory, string $destinationDirectory): void
    {
        $childFolder = '';
        $directory = opendir($sourceDirectory);

        if (is_dir($destinationDirectory) === false) {
            mkdir($destinationDirectory);
        }

        if ($childFolder !== '') {
            if (is_dir("$destinationDirectory/$childFolder") === false) {
                mkdir("$destinationDirectory/$childFolder");
            }

            while (($file = readdir($directory)) !== false) {
                if ($file === '.' || $file === '..') {
                    continue;
                }

                if (is_dir("$sourceDirectory/$file") === true) {
                    $this->recurseCopy("$sourceDirectory/$file", "$destinationDirectory/$childFolder/$file");
                } else {
                    copy("$sourceDirectory/$file", "$destinationDirectory/$childFolder/$file");
                }
            }

            closedir($directory);

            return;
        }

        while (($file = readdir($directory)) !== false) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            if (is_dir("$sourceDirectory/$file") === true) {
                $this->recurseCopy("$sourceDirectory/$file", "$destinationDirectory/$file");
            } else {
                copy("$sourceDirectory/$file", "$destinationDirectory/$file");
            }
        }

        closedir($directory);
    }
}
