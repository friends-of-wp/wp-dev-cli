<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate;

class Configuration
{
    private string $pluginName;
    private string $pluginDescription;
    private string $pluginVersion;
    private string $outputDir;

    /**
     * @param string $pluginName
     * @param string $pluginDescription
     * @param string $pluginVersion
     */
    public function __construct(
        string $pluginName,
        string $pluginDescription,
        string $pluginVersion,
        string $outputDir)
    {
        $this->pluginName = $pluginName;
        $this->pluginDescription = $pluginDescription;
        $this->pluginVersion = $pluginVersion;
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
