<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface Step
{
    /**
     * The constructor.
     */
    public function __construct(Configuration $configuration, InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper);

    /**
     * Every step can ask the user for information needed to run it. All "ask" methods will be
     * called before the first step is executed.
     */
    public function ask(): void;

    /**
     * Run this step with all parameters in the configuration.
     *
     * @return string This string will be shown on the command line after the step
     *                was processed.
     */
    public function run(): string;
}
