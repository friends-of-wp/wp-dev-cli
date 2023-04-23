<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate;

class Configuration
{
    private ?string $pluginName;
    private ?string $pluginDescription;
    private ?string $pluginVersion;
    private ?string $outputDir;

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
}
