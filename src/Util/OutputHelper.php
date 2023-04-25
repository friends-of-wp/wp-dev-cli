<?php

namespace FriendsOfWp\DeveloperCli\Util;

use Symfony\Component\Console\Output\OutputInterface;

abstract class OutputHelper
{
    static public function writeInfoBox(OutputInterface $output, $message): void
    {
        $spaces = self::getSpaces($message);

        $output->writeln("");
        $output->writeln('<bg=cyan>' . $spaces . "</>");
        $output->writeln("<bg=cyan>  " . $message . "  </>");
        $output->writeln('<bg=cyan>' . $spaces . "</>");
        $output->writeln("");
    }

    /**
     * Show a red output box with a warning message.
     */
    static public function writeErrorBox(OutputInterface $output, $message): void
    {
        $spaces = self::getSpaces($message);

        $output->writeln("");
        $output->writeln('<error>' . $spaces . "</error>");
        $output->writeln("<error>  " . $message . "  </error>");
        $output->writeln('<error>' . $spaces . "</error>");
        $output->writeln("");
    }

    /**
     * Fill out the spaces in the trailing empty lines in the box.
     */
    static private function getSpaces(string $message, $additionalSpaces = 4): string
    {
        return str_repeat(' ', strlen($message) + $additionalSpaces);
    }
}
