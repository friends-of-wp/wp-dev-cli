<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate\Step;

use FriendsOfWp\DeveloperCli\Boilerplate\Configuration;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Question\Question;

class PrepareAdminStep extends SimpleStep
{
    private array $adminPages = [];

    /**
     * @inheritDoc
     */
    public function ask(QuestionHelper $questionHelper): void
    {
        $string = 'a';
        if ($this->getConfiguration()->isAdminPlugin()) {
            while ($this->askYesNoQuestion('Do you want to add ' . $string . ' page in the WordPress admin area', $questionHelper)) {
                $string = 'another';
                $this->getOutput()->writeln('');
                $newPage = $questionHelper->ask($this->getInput(), $this->getOutput(), new Question('What is the name of that page? '));
                if ($newPage) {
                    $this->adminPages[] = $newPage;
                }
                $this->getOutput()->writeln('');
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function run(): string
    {
        $configuration = $this->getConfiguration();

        if ($configuration->isAdminPlugin()) {
            $this->runIncludesAdd();
            $this->runPageCreation();
        }

        return "Plugin enriched with admin functionalities. Added " . count($this->adminPages) . " admin pages.";
    }

    private function runPageCreation(): void
    {
        foreach ($this->adminPages as $adminPage) {
            $this->copyPage($adminPage);
            $this->copyTemplate($adminPage);
        }
    }

    /**
     * Copy the admin page.
     */
    private function copyPage($pageName)
    {
        $from = __DIR__ . '/templates/admin/page.php';
        $toDir = $this->getConfiguration()->getOutputDir() . '/' . Configuration::PLUGIN_DIR . '/includes/pages';
        $this->copyFile($pageName, $from, $toDir);
    }

    /**
     * Copy the admin page.
     */
    private function copyTemplate($pageName)
    {
        $from = __DIR__ . '/templates/admin/template.php';
        $toDir = $this->getConfiguration()->getOutputDir() . '/' . Configuration::PLUGIN_DIR . '/templates';
        $this->copyFile($pageName, $from, $toDir);
    }

    /**
     * Copy the prepared files.
     */
    private function copyFile($pageName, $from, $toDir)
    {
        if (!file_exists($toDir)) {
            mkdir($toDir, 0777, true);
        }
        $filename = $this->getFilename($pageName);
        $to = $toDir . '/' . $filename . '.php';
        $this->enrichedCopy($from, $to, [
            'PAGE_NAME' => $pageName,
            'FILE_NAME' => $filename
        ]);
    }

    /**
     * Create the file name out of the page name
     */
    private function getFilename(string $pageName): string
    {
        $separator = "-";

        $str = lcfirst($pageName);
        $str = preg_replace("/[A-Z]/", $separator . "$0", $str);
        $str = str_replace(' ', '-', strtolower($str));

        return str_replace('--', '-', $str);
    }

    /**
     * Add all needed includes to the boilerplate bootstrap file.
     */
    private function runIncludesAdd(): void
    {
        $configuration = $this->getConfiguration();
        $bootstrapFile = $configuration->getPluginBootstrapFile();
        $include = "include_once ABSPATH . 'wp-admin/includes/admin.php';\n";
        $content = file_get_contents($bootstrapFile);
        $content = str_replace(Configuration::BOOTSTRAP_PLACEHOLDER_INCLUDES, Configuration::BOOTSTRAP_PLACEHOLDER_INCLUDES . "\n" . $include, $content);
        file_put_contents($bootstrapFile, $content);
    }
}
