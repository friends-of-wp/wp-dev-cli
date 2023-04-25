<?php

namespace FriendsOfWp\DeveloperCli\Boilerplate;

use http\Exception\RuntimeException;

class Configuration
{
    const BOOTSTRAP_PLACEHOLDER_INCLUDES = '# INCLUDES';

    const PLUGIN_DIR = 'plugin';
    const PLUGIN_BOILERPLATE_FILE = 'plugin-boilerplate.php';
    const PARAM_PLUGIN_NAME = 'core_plugin_name';
    const PARAM_PLUGIN_DESCRIPTION = 'core_plugin_description';
    const PARAM_PLUGIN_OUTPUT_DIR = 'core_plugin_output_directory';
    const PARAM_PLUGIN_VERSION = 'core_plugin_version';

    const PARAM_PLUGIN_IS_ADMIN = 'core_plugin_is_admin';

    private array $parameters = [];


    /**
     * @param string $pluginName
     */
    public function setPluginName(string $pluginName): void
    {
        $this->setParameter(self::PARAM_PLUGIN_NAME, $pluginName);
    }

    /**
     * @param string $pluginDescription
     */
    public function setPluginDescription(string $pluginDescription): void
    {
        $this->setParameter(self::PARAM_PLUGIN_DESCRIPTION, $pluginDescription);
    }

    /**
     * @param string $pluginVersion
     */
    public function setPluginVersion(string $pluginVersion): void
    {
        $this->setParameter(self::PARAM_PLUGIN_VERSION, $pluginVersion);
    }

    /**
     * @param string $outputDir
     */
    public function setOutputDir(string $outputDir): void
    {
        $this->setParameter(self::PARAM_PLUGIN_OUTPUT_DIR, $outputDir);
    }

    /**
     * @return string
     */
    public function getPluginName(): string
    {
        return $this->getParameter(self::PARAM_PLUGIN_NAME);
    }

    /**
     * @return string
     */
    public function getPluginDescription(): string
    {
        return $this->getParameter(self::PARAM_PLUGIN_DESCRIPTION);
    }

    /**
     * @return string
     */
    public function getPluginVersion(): string
    {
        return $this->getParameter(self::PARAM_PLUGIN_VERSION);
    }

    /**
     * @return string
     */
    public function getOutputDir(): string
    {
        return $this->getParameter(self::PARAM_PLUGIN_OUTPUT_DIR);
    }

    public function getNormalizedPluginName(): string
    {
        $separator = "-";

        $str = lcfirst($this->getPluginName());
        $str = preg_replace("/[A-Z]/", $separator . "$0", $str);

        $str = str_replace(' ', '-', strtolower($str));

        return str_replace('--', '-', $str);
    }

    public function getConstantPluginName(): string
    {
        return strtoupper(str_replace('-', '_', $this->getNormalizedPluginName())) . '_NAME';
    }

    /**
     * Return a pre-stored parameter
     */
    public function getParameter(string $key): string
    {
        if (!$this->hasParameter($key)) {
            throw  new \RuntimeException('No parameter with key "' . $key . '" found');
        }

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

    public function hasParameter(string $key): bool
    {
        return array_key_exists($key, $this->parameters);
    }

    public function getPluginBootstrapFile(): string
    {
        return $this->getOutputDir() . '/' . self::PLUGIN_DIR . '/' . self::PLUGIN_BOILERPLATE_FILE;
    }
}
