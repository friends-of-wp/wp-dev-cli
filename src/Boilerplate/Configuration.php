<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate;

class Configuration
{
    private string $pluginName;
    private string $pluginSlug;
    private string $pluginDescription;
    private string $pluginVersion;
    private string $outputDir;

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
        return str_replace(' ', '-', strtolower($this->getPluginName()));
    }
}
