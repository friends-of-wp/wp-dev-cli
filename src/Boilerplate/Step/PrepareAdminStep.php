<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Question\Question;

class PrepareAdminStep extends SimpleStep
{
    public function ask(QuestionHelper $questionHelper): void
    {
        if ($this->getConfiguration()->isAdminPlugin()) {
            while ($this->askYesNoQuestion('Do you want to add a/another page in the WordPress area', $questionHelper)) {
                $questionHelper->ask($this->getInput(), $this->getOutput(), new Question('Do you want to add a page in the WordPress area?'));
            }
        }
    }

    public function run(): string
    {
        $configuration = $this->getConfiguration();

        if ($configuration->isAdminPlugin()) {
            $this->runIncludesAdd($configuration);
            $this->runPageCreation($configuration);
        }

        return "Plugin enriched with admin functionalities";
    }

    private function runPageCreation(Configuration $configuration): void
    {
        // $replacements =
    }

    /**
     * Add all needed includes to the boilerplate bootstrap file.
     */
    private function runIncludesAdd(Configuration $configuration): void
    {
        $bootstrapFile = $configuration->getPluginBootstrapFile();
        $include = "include_once ABSPATH . 'wp-admin/includes/admin.php';\n";
        $content = file_get_contents($bootstrapFile);
        $content = str_replace(Configuration::BOOTSTRAP_PLACEHOLDER_INCLUDES, Configuration::BOOTSTRAP_PLACEHOLDER_INCLUDES . "\n" . $include, $content);
        file_put_contents($bootstrapFile, $content);
    }
}
