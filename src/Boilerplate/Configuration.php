<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate;

class Configuration
{
    const BOOTSTRAP_PLACEHOLDER_INCLUDES = '# INCLUDES';

    const PLUGIN_DIR = 'plugin';
    const PLUGIN_BOILERPLATE_FILE = 'plugin-boilerplate.php';

    private string $pluginName;
    private string $pluginSlug;
    private string $pluginDescription;
    private string $pluginVersion;
    private string $outputDir;

    private bool $isAdminPlugin;

    private array $parameters = [];

    /**
     * @return string
     */
    public function getPluginSlug(): string
    {
        return $this->pluginSlug;
    }

    /**
     * @param string $pluginSlug
     */
    public function setPluginSlug(string $pluginSlug): void
    {
        $this->pluginSlug = $pluginSlug;
    }

    /**
     * @param string $pluginName
     */
    public function setPluginName(string $pluginName): void
    {
        $this->pluginName = $pluginName;
    }

    /**
     * @param string $pluginDescription
     */
    public function setPluginDescription(string $pluginDescription): void
    {
        $this->pluginDescription = $pluginDescription;
    }

    /**
     * @param string $pluginVersion
     */
    public function setPluginVersion(string $pluginVersion): void
    {
        $this->pluginVersion = $pluginVersion;
    }

    /**
     * @param string $outputDir
     */
    public function setOutputDir(string $outputDir): void
    {
        $this->outputDir = $outputDir;
    }

    /**
     * @return string
     */
    public function getPluginName(): string
    {
        return $this->pluginName;
    }

    /**
     * @return string
     */
    public function getPluginDescription(): string
    {
        return $this->pluginDescription;
    }

    /**
     * @return string
     */
    public function getPluginVersion(): string
    {
        return $this->pluginVersion;
    }

    /**
     * @return string
     */
    public function getOutputDir(): string
    {
        return $this->outputDir;
    }

    public function getNormalizedPluginName(): string
    {
        $separator = "-";

        $str = lcfirst($this->getPluginName());
        $str = preg_replace("/[A-Z]/", $separator . "$0", $str);

        $str = str_replace(' ', '-', strtolower($str));

        return str_replace('--', '-', $str);
    }

    /**
     * @return bool
     */
    public function isAdminPlugin(): bool
    {
        return $this->isAdminPlugin;
    }

    /**
     * @param bool $isAdminPlugin
     */
    public function setIsAdminPlugin(bool $isAdminPlugin): void
    {
        $this->isAdminPlugin = $isAdminPlugin;
    }

    /**
     * @param string $key
     * @return array
     */
    public function getParameter(string $key): array
    {
        return $this->parameters[$key];
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function setParameter(string $key, mixed $value): void
    {
        $this->parameters[$key] = $value;
    }

    public function getPluginBootstrapFile(): string
    {
        return $this->getOutputDir() . '/' . self::PLUGIN_DIR . '/' . self::PLUGIN_BOILERPLATE_FILE;
    }
}
