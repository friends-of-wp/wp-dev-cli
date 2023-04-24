<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class PrepareAdminStep extends SimpleStep
{
    public function ask(Configuration $configuration, InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): void
    {
        if ($configuration->isAdminPlugin()) {
            // $questionHelper->ask($input, $output, new ConfirmationQuestion(''));
        }
    }


    # INCLUDES


    public function run(Configuration $configuration): string
    {
        if ($configuration->isAdminPlugin()) {
            $bootstrapFile = $configuration->getPluginBootstrapFile();
            $include = "include_once ABSPATH . 'wp-admin/includes/admin.php';\n";
            $content = file_get_contents($bootstrapFile);
            $content = str_replace(Configuration::BOOTSTRAP_PLACEHOLDER_INCLUDES, Configuration::BOOTSTRAP_PLACEHOLDER_INCLUDES . "\n" . $include, $content);
            file_put_contents($bootstrapFile, $content);
        }

        return "Plugin enriched with admin functionalities";
    }
}
