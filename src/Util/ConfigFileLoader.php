<?php

namespace FriendsOfWp\DeveloperCli\Util;

use Symfony\Component\Yaml\Yaml;

class ConfigFileLoader
{
    /**
     * Load a configuration YAML file. A default YAML file can be added that will be merged
     * with the other file.
     */
    static public function loadYamlConfig(string $configFile, string $defaultConfigFile = ''): array
    {

        if ($defaultConfigFile) {
            if (!file_exists($defaultConfigFile)) {
                throw new \RuntimeException("The given default config file '$defaultConfigFile' does not exist.");
            }
            $defaultConfig = Yaml::parse(file_get_contents($defaultConfigFile));
        } else {
            $defaultConfig = [];
        }

        if ($configFile) {
            if (!file_exists($configFile)) {
                throw new \RuntimeException("The given config file '$configFile' does not exist.");
            }
            $customConfig = Yaml::parse(file_get_contents($configFile));
        } else {
            $customConfig = [];
        }

        return array_merge($customConfig, $defaultConfig);
    }
}
