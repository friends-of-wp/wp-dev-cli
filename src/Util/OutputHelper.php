<?php

namespace FriendsOfWp\DeveloperCli\Util;

use Symfony\Component\Console\Output\OutputInterface;

abstract class OutputHelper
{
    /**
     * Show a blue output box with a info message.
     */
    static public function writeInfoBox(OutputInterface $output, string $message): void
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
    static public function writeErrorBox(OutputInterface $output, string|array $message): void
    {
        $maxLength = 0;

        if (!is_array($message)) {
            $message = [$message];
        }

        foreach ($message as $singleMessage) {
            $maxLength = max($maxLength, strlen($singleMessage));
        }

        $spaces = self::getSpaces($message[0]);

        $output->writeln("");
        $output->writeln('<error>' . self::getPreparedMessage('', $maxLength, 4) . "</error>");

        foreach ($message as $singleMessage) {
            $output->writeln("<error>  " . self::getPreparedMessage($singleMessage, $maxLength, 2) . "</error>");
        }

        $output->writeln('<error>' . $spaces . "</error>");
        $output->writeln("");
    }

    /**
     * Add whitespaces to the message of needed to fit to the box.
     */
    static private function getPreparedMessage(string $message, int $maxLength, $additionalSpaces = 0): string
    {
        return $message . str_repeat(' ', $maxLength - strlen($message) + $additionalSpaces);
    }

    /**
     * Fill out the spaces in the trailing empty lines in the box.
     */
    static private function getSpaces(string $message): string
    {
        return str_repeat(' ', strlen($message) + 4);
    }
}
